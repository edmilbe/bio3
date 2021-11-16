<?php

class DB{
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_result, $_count = 0, $_lastInsertID = null;

    public static $esse = 0;

    private function __construct(){

        try{
            $this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        }catch (PDOException $e){
            die($e->getMessage());
        }
    }
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = []){
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)){



            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            //var_dump($this->_query);



            if($this->_query->execute()){
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count  = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertId();

            }else{
                dnd($this->_query->errorInfo());

                $this->_error = true;
            }
        }
        return $this;
    }

    protected function _read($table, $params =[]){
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';

        //conditions

        if(isset($params['conditions'])){
            if(is_array($params['conditions'])){
                foreach($params['conditions'] as $condition){
                    $conditionString .= ' ' .$condition . ' AND';
                 }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, ' AND');
            }else{
                $conditionString = $params['conditions'];

            }
            if($conditionString != ''){
                $conditionString = ' WHERE ' .$conditionString;
            }
        }


        //bind

        if(array_key_exists('bind', $params)){
            $bind = $params['bind'];
        }

        //order

        if(array_key_exists('order', $params)){
            $order = ' ORDER BY ' . $params['order'];
        }


        //limit
        if(array_key_exists('limit', $params)){
            $limit = ' LIMIT ' . $params['limit'];
        }
        $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
       //var_dump($sql);
        if($this->query($sql, $bind)){
            if(!count($this->results())){
                return false;
            }else{
                return true;
            }
        }
        return false;

    }

    public function find($table, $params = []){
        if($this->_read($table, $params)){
            return $this->results();
        }
        return false;
    }

    public function findFirst($table, $params = []){

        if($this->_read($table, $params)){
            return $this->first();
        }
        return false;
    }


    public function insert($table, $fields = []){
        $fieldString = '';
        $valueString = '';
        $values = [];

        foreach($fields as $field => $value){
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[] = $value;
        }
        $fieldString = rtrim($fieldString, ',');//delete the last virgule
        $valueString = rtrim($valueString, ',');//delete the last virgule

        $sql = "INSERT INTO {$table} ({$fieldString})VALUES({$valueString})";

        //dnd(  $sql);

        if(!$this->query($sql, $values)->error()){
            return true;
        }
        return false;
    }

    public function update($table,$id, $fields = [], $column){

        $fieldString = '';
        $values = [];

        foreach($fields as $field => $value){
            $fieldString .= ' ' . $field . ' = ?, ';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);

        $fieldString = rtrim($fieldString, ',');//delete the last virgule

        $sql = "UPDATE {$table}  SET {$fieldString} WHERE $column = {$id}";

        //var_dump($sql);
        if(!$this->query($sql, $values)->error()){
            return true;
        }
        return false;
    }


    public function delete($table,$id, $colum = ''){

        $sql = "DELETE FROM {$table} WHERE {$colum}={$id}";

        if(!$this->query($sql)->error()){
            return true;
        }
        return false;
    }

    public function error(){
        return $this->_error;
    }

    public function results(){
        return $this->_result;
    }

    public function first(){
        return (!empty($this->_result)) ? $this->_result[0] : [];
    }

    public function count(){
        return $this->_count;
    }


    public function lastID(){
        return $this->_lastInsertID;
    }

    public function get_colums($table){
        //var_dump($table);
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }


}