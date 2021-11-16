<?php

class EmailsUser extends  Model{


    public function __construct(){
        $table = 'emails_user';
        parent::__construct($table);
    }

    public function emailExistis($email){
        $email = sanitize($email);
        $este = $this->find([
            'conditions' => ['email_u_name = ?'],
            'bind'=>[$email]
        ]);
        if($este){
           return $este[0];
        }
        return false;
    }

    public function getEmailUser($user){
        $email = sanitize($user);
        $este = $this->findFirst([
            'conditions' => ['email_u_user = ?'],
            'bind'=>[$email],
            'order ' => 'email_u_id desc'
        ]);
        if($este){
            return $este->email_u_name;
        }
        return false;
    }

    function saveEmail($email, $user){
        $form['email_u_user'] = sanitize($user);
        $form['email_u_name'] = sanitize($email);

        $this->save($form);

        return $this->_db->lastID();
    }

    function updateEmail($email, $user){



        if($this->emailExistis($this->getEmailUser(sanitize($user)))){

            $form['email_u_name'] = sanitize($email);

            $this->update($user,$form,"email_u_user");
        }else{
            $this->saveEmail($email, $user);
        }


    }
}