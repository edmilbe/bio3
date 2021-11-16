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

                        $this->addError(["Insira  {$display}", $item]);
                    }
                    if($rule === 'multi-img' && empty($value['name'][0])){

                        $this->addError(["Insira {$display}", $item]);
                    }
                    if(!empty($value)){
                        switch($rule){
                            case 'min':
                                if(strlen($value) < $rule_value ){
                                    $this->addError(["{$display} tem que ter mínimo {$rule_value} digitos.", $item]);
                                }
                                break;
                            case 'max':
                                if(strlen($value) > $rule_value ){
                                    $this->addError(["{$display} tem que ter máximo {$rule_value} digitos.", $item]);
                                }
                                break;
                            case 'min-value':
                                if(intval($value) < $rule_value){
                                    $this->addError(["{$display} tem que ser maior ou igual a  {$rule_value}.", $item]);
                                }
                                break;
                            case 'max-value':
                                if( intval($value) > $rule_value){
                                    $this->addError(["{$display} tem que ser melor ou igual a  {$rule_value}.", $item]);
                                }
                                break;
                            case 'matches':
                                if($value !=  $source[$rule_value]){
                                    $matchDisplay = $items[$rule_value]['display'];
                                    $this->addError(["{$matchDisplay} e {$display} não correspondem.", $item]);

                                }
                                break;
                            case 'unique':
                                $rule_v = $rule_value[0];
                                $item = $rule_value[1];

                                $check = $this->_db->query("SELECT {$item} FROM {$rule_v} WHERE {$item} = ?", [$value]);


                                if($check->count()){

                                    $this->addError(["{$value}  ja esta registrado!", $item]);

                                }
                                break;
                            case 'unique_update':

                                $table      = $rule_value[0];
                                $column     = $rule_value[1];
                                $column_m   = $rule_value[2];
                                $column_mv  = $rule_value[3];


                                $query = $this->_db->query("SELECT * FROM {$table} WHERE {$column_m} != ? AND {$column} = ?", [$column_mv, $value]);


                                if($query->count()){
                                    $this->addError(["{$display} ja esta registrado!", $item]);

                                }
                                break;
                            case 'is_numeric':
                                if(!is_numeric($value)){
                                    $this->addError(["{$display} tem que ser um número. Use apenas números!", $item]);

                                }
                                break;
                            case 'valid_email':
                                if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                    $this->addError(["must be a valid email address.", $item]);

                                }
                                break;
                            case 'selected':
                                $table      = $rule_value[0];
                                $column     = $rule_value[1];



                                $query = $this->_db->query("SELECT * FROM {$table} WHERE {$column} = ?", [$value]);


                                if(!$query->count()){
                                    $this->addError(["Choose a valid {$display}", $item]);

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
                                    $this->addError(["Type of {$display} must to be: " . implode(', ', $rule_value). ".", $item]);
                                }
                                break;
                            case 'check-pass-user':

                                $emailO = new EmailsUser();
                                $userO = new Users();
                                $user = $userO->findByEmail($emailO->getEmailUser(currentUser()->user_id));


                                if ($user) {
                                    if ($user->user_active == 1) {
                                        //dnd(Token::make($password,$user->user_key));
                                        //dnd($user->password);


                                        if (Token::make($value, $user->user_key) === $user->password && $user) {

                                        } else {
                                            $this->addError("Current password incorrect!");
                                        }
                                    } else {
                                        $this->addError( "Your account was suspended!");
                                    }

                                } else {
                                    $this->addError("Email or password incorrect!");
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
            $this->addError(["Missing " . $missing . " input(s)"  , '']);
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

    public function displayErrors($success = false){

        if($success == false){

        }
        $html = "";
        foreach($this->_errors as $error) {

            if (is_array($error)) {


                $html .=   '<span class="response__text response__text--error">' . utf8_encode($error[0] ). '</span>';
            } else {
                $html .=   '<span class="response__text response__text--okay">' . utf8_encode($error ) . '</span>';
            }
        }
        //var_dump($html);
        return $html;
    }
    public function displayOkay($msg){


        $html =   '<span class="response__text response__text--okay">' . $msg . '</span>';

        return $html;
    }

    public function displayError($msg){


        $html =   '<span class="response__text response__text--error">' . $msg . '</span>';

        return $html;
    }




}//milan //