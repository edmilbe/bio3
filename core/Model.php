<?php

class Model{
    protected $_db, $_table, $_modelName, $_softDelete = false, $_columnNames = [], $_count;
    public $id;

    public function __construct($table){
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->_setTableColumns();
        $this->_modelName = str_replace(' ', '',ucwords(str_replace('_', ' ', $this->_table)));

    }
    protected function _setTableColumns(){
        $columns = $this->get_columns();

        foreach($columns as $column){
            $columnName = $column->Field;
            $this->_columnNames[] = $column->Field;
            $this->{$columnName} = null;
        }
    }

    public function get_columns(){
        return $this->_db->get_colums($this->_table);
    }

    public function find($params){
        //insert
        $results = [];
        $resultsQuery = $this->_db->find($this->_table, $params);

        if($resultsQuery != false){
            foreach($resultsQuery as $result){
                $obj = new $this->_modelName($this->_table);
                //obj = 'contacts'
                $obj->populateObjData($result);
                $results[] = $obj;
            }
        }

        return $results;
    }






    public function findFirst($params){

        $resultsQuery = $this->_db->findFirst($this->_table, $params);
        $result = new $this->_modelName($this->_table);
        if($resultsQuery){
            $result->populateObjData($resultsQuery);

        }
        return $result;
    }



    public function save($fields){
        /*$fields = [];
        foreach($this->_columnNames as $column){
            $fields[$column] = $this->$column;
            //$fields[fname] = $this->$fname;
        }*/
        //determine whether to update or insert


        return $this->insert($fields);


    }

    public function insert($fields){
        if(empty($fields)) return false;

        return $this->_db->insert($this->_table, $fields);
    }

    public function update($id,$fields, $column){
        if(empty($fields) || $id == '') return false;

        return $this->_db->update($this->_table,$id,$fields, $column);
    }

    public function delete($id = '', $column){
        if($id == '' && $this->id == '') return false;

        $id = ($id == '') ? $this->id : $id;

        if($this->_softDelete){
            return $this->update(currentUser()->user_id, ['user_deleted' => 1], $column);
        }
        return $this->_db->delete($this->_table, $id, $column);
    }

    public function query($sql, $bind = []){
        return $this->_db->query($sql, $bind);
    }


    public function data(){
        $data = new stdClass();
        foreach($this->_columnNames as $column){
            //$data->column = $this->$column;
            $data->column = $this->column;
        }
        return $data;
    }

    public function assign($params){
        if(!empty($params)){
            foreach($params as $key => $val){
                if(in_array($key, $this->_columnNames)){
                    $this->$key = sanitize($val);
                }
            }
            return true;
        }
        return false;
    }

    protected function populateObjData($result){
        foreach($result as $key => $val){
            $this->$key = $val;
            //contact-name = 'edmilbe'
            //contact-lname = 'ramos'
        }
    }

    public function Count(){
        $this->_db->count();

    }

    public function RowsNumber($column = null,$status = null, $count_column= "post_id" ){

        if($status != null && $column != null){
            $status = " WHERE " . $column . " = " . $status;
        }
        //dnd($this->_modelName);
        $query = "SELECT COUNT($count_column) as num FROM " . strtolower($this->_modelName) . $status;

        //dnd($query);

        return $this->_db->query($query, [])->results()[0]->num;



    }
}
/*
 * esclarecer o povo sobre a estragia de implementacao da ditadura
 * unir tds que estao a contra ditadura
 *
 */



