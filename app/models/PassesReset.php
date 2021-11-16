<?php

class PassesReset extends  Model{


    public function __construct(){
        $table = 'passes_reset';
        parent::__construct($table);
    }



    function saveReset($key, $user){
        $form['passe_r_user'] = sanitize($user);
        $form['passe_r_on'] = 2;
        $link = $form['passe_r_key'] = sanitize($key);

        $this->save($form);

        return $this->_db->lastID();
    }







}