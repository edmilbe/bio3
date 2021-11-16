<?php

class Acls extends  Model{


    public function __construct(){
        $table = 'acls';
        parent::__construct($table);
    }

    public function getAcl($id){
        $localidade = $this->findFirst([

            'conditions' => 'acl_id = ?', 'bind'  => [$id]


        ]);


        return $localidade;


    }


    public function getName($estado){
        $localidade = $this->findFirst([

            'conditions' => 'acl_id = ?', 'bind'  => [sanitize($estado)]


        ]);

        return $localidade->acl_name;

        //$oa = $bi->bi_sexo  == 1 ? "o" : "a";
        //$dados['estado'] = $bi->bi_estado == 1 ? "solteir".$oa : ($bi->bi_estado == 2 ? "casad".$oa: ($bi->bi_estado == 3 ? "divorciad".$oa : ($bi->bi_estado == 4 ? "viuv".$oa: "em comunhão de facto")) );

    }


    public function newSave($form){

        $params['acl_name'] = sanitize($form['acl']);

        $this->save($params);

        return $this->_db->lastID();
    }



    public function aclUsers($acl){

        return $this->_db->query(

        "SELECT * FROM acls JOIN acl_users JOIN users ON acl_id = ? AND acl_id = acl_user_acl AND acl_user_user = user_id",[$acl])->results();
    }






}