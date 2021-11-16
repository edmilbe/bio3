<?php

class AclUsers extends  Model{


    public function __construct(){
        $table = 'acl_users';
        parent::__construct($table);
    }

    public function getAcl($user){

        return $this->_db->query("SELECT *FROM acl_users INNER JOIN acls
                          ON acl_user_user = ? AND acl_id = acl_user_acl", [$user])->results();

    }

    public function getAclCheck($user, $acl){

        return $this->_db->query("
              SELECT *FROM acl_users WHERE
              acl_user_user = ? AND acl_user_acl = ? ", [$user, $acl])->results();



    }


    public function getName($estado){
        $localidade = $this->findFirst([

            'conditions' => 'acl_user_id = ?', 'bind'  => [sanitize($estado)]


        ]);

        return $localidade;

        //$oa = $bi->bi_sexo  == 1 ? "o" : "a";
        //$dados['estado'] = $bi->bi_estado == 1 ? "solteir".$oa : ($bi->bi_estado == 2 ? "casad".$oa: ($bi->bi_estado == 3 ? "divorciad".$oa : ($bi->bi_estado == 4 ? "viuv".$oa: "em comunhão de facto")) );

    }


    public function newSave($form){

        if(!$this->getAclCheck(sanitize($form['user']), sanitize($form['acl']))){

            $params['acl_user_user'] = sanitize($form['user']);
            $params['acl_user_acl'] = sanitize($form['acl']);

            $this->save($params);

            $id = $this->_db->lastID();
            $Users = new Users();

            $Users->updateAcl($params['acl_user_user']);

            return $id;



        }

        return 0;



    }


    public function removeAcl($acl, $user){



        $useracl = $this->getAclCheck($user, sanitize($acl));

       // dnd($useracl);

        if($useracl) {



            $this->delete($useracl[0]->acl_user_id,"acl_user_id");

            $id = $this->_db->lastID();
            $Users = new Users();

            $Users->updateAcl($user);

            return $id;


        }


        return 0;



    }






}