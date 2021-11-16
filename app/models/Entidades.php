<?php

class Entidades extends  Model{


    public function __construct(){
        $table = 'entidades';
        parent::__construct($table);
    }

    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'entidade_id = ?', 'bind'  => [$id]


        ]);


        return $localidade;


    }


    public function newSave($form){

        $params['entidade_name'] = sanitize($form['entidade']);

        $this->save($params);

        return $this->_db->lastID();
    }






}