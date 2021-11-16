<?php

class Members extends  Model{


    public function __construct(){
        $table = 'members';
        parent::__construct($table);
    }

    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'member_id = ?', 'bind'  => [$id]


        ]);


        return $localidade;


    }


    public function newSave($form){

        $params['member_name'] = sanitize($form['membro']);

        $this->save($params);

        return $this->_db->lastID();
    }













}