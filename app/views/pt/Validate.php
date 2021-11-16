<?php

class Validate{
    private $_passed = true, $_errors = [], $_db = null;


    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = [], $files = []){
        $this->_errors = [];
        $missing = -1;
        foreach($items as $item => $rules){
            $item  = Input::sanitize($item);
            $display = $rules['display'];

            foreach($rules as $rule => $rule_value){

                if(isset($files[$item])){
                    $value = $files[$item];
                }elseif(isset($source[$item])){
                    $value = Input::sanitize(trim($source[$item]));

                }

                if(isset($files[$item]) || isset($source[$item])){
                    if($rule === 'require' && empty($value)){
                        $this->addError(["Insira {$display}", $item]);
                    }

                    if($rule === 'require-pic' && empty($value['name'])){

                        $this->addError(["Insira {$display}", $item]);
                    }
                    if($rule === 'multi-img' && empty($value['name'][0])){

                        $this->addError(["Insira {$display}", $item]);
                    }

                    if(!empty($value)){
                        switch($rule){
                            case 'min':
                                if(strlen($value) < $rule_value || intval($value) !== $rule_value ){
                                    $this->addError(["{$display} deve ter no minimo {$rule_value} caracteres.", $item]);
                                }
                                break;
                            case 'max':
                                if(strlen($value) > $rule_value || intval($value) !== $rule_value){
                                    $this->addError(["{$display} deve ter no máximo {$rule_value} caracteres.", $item]);
                                }
                                break;
                            case 'matches':
                                if($value !=  $source[$rule_value]){
                                    $matchDisplay = $items[$rule_value]['display'];
                                    $this->addError(["{$matchDisplay} e {$display} devem ser identicas.", $item]);

                                }
                                break;
                            case 'unique':
                                $rule_v = $rule_value[0];
                                $item = $rule_value[1];

                                $check = $this->_db->query("SELECT {$item} FROM {$rule_v} WHERE {$item} = ?", [$value]);


                                if($check->count()){

                                    $this->addError(["{$value} ja existe. Escolha outro(a) {$display}.", $item]);

                                }
                                break;
                            case 'unique_update':

                                $table      = $rule_value[0];
                                $column     = $rule_value[1];
                                $column_m   = $rule_value[2];
                                $column_mv  = $rule_value[3];


                                $query = $this->_db->query("SELECT * FROM {$table} WHERE {$column_m} != ? AND {$column} = ?", [$column_mv, $value]);


                                if($query->count()){
                                    $this->addError(["{$display} já existe. Escolha  {$display} diferente", $item]);

                                }
                                break;
                            case 'is_numeric':
                                if(!is_numeric($value)){
                                    $this->addError(["{$display} deve ser um número. Por favor use um número.", $item]);

                                }
                                break;
                            case 'valid_email':
                                if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                    $this->addError(["Insira um email válido.", $item]);

                                }
                                break;
                            case 'checked':
                                if($value == false){
                                    $this->addError(["Escolha {$display}.", $item]);
                                }
                                break;
                            case 'selected':
                                $table      = $rule_value[0];
                                $column     = $rule_value[1];

                                //var_dump("SELECT * FROM {$table} WHERE {$column} = ?");

                                $query = $this->_db->query("SELECT * FROM {$table} WHERE {$column} = ?", [$value]);


                                if(!$query->count()){
                                    $this->addError(["Escolha {$display}.", $item]);

                                }
                                break;
                            case 'files-types':
                                $flag = true;
                                //dnd($rule_value);
                                if(is_array($value['name'])){
                                    foreach($value['name'] as $key => $file_name){
                                        $file_ext = explode(".",$file_name);
                                        $file_ext = strtolower(end($file_ext));
                                    }
                                }else{
                                    $file_ext = explode(".",$value['name']);
                                    $file_ext = strtolower(end($file_ext));
                                }
                                if(!in_array($file_ext, $rule_value)){
                                    $flag = false;
                                }

                                if(!$flag){
                                    $this->addError(["{$display} de tipos: " . implode(', ', $rule_value). ".", $item]);
                                }
                                break;
                            case 'check-pass-user':
                                $passe = new PassesUser();
                                $u = $passe->findFirst(['conditions' => ['passe_u_user = ? '], 'bind' => [currentUser()->user_id]]);
                                if(!password_verify($value, $u->passe_u_name)){
                                    $this->addError(["{$display} esta incorrecto.", $item]);

                                }
                                break;
                        }
                    }
                }else{
                    $missing++;

                }
            }
        }
        if($missing >= 1){
            $this->addError(["Faltando " . $missing . " input(s)"  , '']);
        }
        //var_dump($this->errors());

        if(empty($this->_errors)){
            $this->_passed = true;
        }
        return $this;


    }
    public function addError($error){


        if(count($this->errors()) == 0){
            $this->_errors[] = $error;//464
        }
        if(empty($this->errors())){

            $this->_passed = true;
        }else{
            $this->_passed = false;

        }


    }

    public function errors(){

        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }

    public function displayErrors(){


        $html = "";
        foreach($this->_errors as $error) {

            if (is_array($error)) {
                $html .=   $error[0];
            } else {
                $html .=   $error;
            }
        }
        //var_dump($html);
        return $html;
    }




}//milan //