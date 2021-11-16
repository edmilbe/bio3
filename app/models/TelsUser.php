<?php

class TelsUser extends  Model{


    public function __construct(){
        $table = 'tels_user';
        parent::__construct($table);
    }

    public function telExistis($tel){
        $tel = sanitize($tel);
        return $this->findFirst(['conditions' => ['tel_u_name = ?'], 'bind'=>[$tel]]);

    }

    function saveTel($tel, $user){
        $form['tel_u_user'] = sanitize($user);
        $form['tel_u_name'] = sanitize($tel);

        $this->save($form);

        return $this->_db->lastID();
    }

    function updateTel($tel, $user){

        if($this->telExistis($this->getTelUser(sanitize($user)))) {
            $user = sanitize($user);
            $form['tel_u_name'] = sanitize($tel);

            $this->update($user, $form, "tel_u_user");
        }else{
            $this->saveTel($tel,$user);
        }
    }

    public function getTelUser($user){
        $email = sanitize($user);
        $este = $this->findFirst([
            'conditions' => ['tel_u_user = ?'],
            'bind'=>[$email],
            'order ' => 'tel_u_id desc'
        ]);
        if($este){
            return $este->tel_u_name;
        }
        return false;
    }
}