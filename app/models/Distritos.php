<?php

class Distritos extends  Model{


    public function __construct(){
        $table = 'distritos';
        parent::__construct($table);
    }


    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'distrito_id = ?', 'bind'  => [$id]


        ]);



        return $localidade;


    }

    public function newSave($form){

        $params['distrito_name'] = sanitize($form['distrito']);
        $params['distrito_pais'] = sanitize($form['pais']);

        $this->save($params);

        return $this->_db->lastID();
    }








}