<?php

class PassesUser extends  Model{


    public function __construct(){
        $table = 'passes_user';
        parent::__construct($table);
    }

    function savePasse($pass, $user, $hash){
        $form['passe_u_user'] = sanitize($user);

        $form['passe_u_name'] = Token::make(sanitize($pass), $hash);

        $this->save($form);

        return $this->_db->lastID();
    }

    function updatePasse($pass, $user){

        $form['user_key'] = $hash = utf8_encode(Token::hash(32));

        $userO = new Users();

        $userO->update($user,$form,'user_id');

        $form = array();

        $user = sanitize($user);


        $form['passe_u_user'] = sanitize($user);

        $form['passe_u_name'] = Token::make(sanitize($pass), $hash);

        $this->update($user,$form,"passe_u_user");
    }



}