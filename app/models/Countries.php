<?php

class Countries extends  Model{


    public function __construct(){
        $table = 'countries';
        parent::__construct($table);
    }

    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'country_id = ?', 'bind'  => [$id]


        ]);


        return $localidade;


    }


    public function newSave($form){

        $params['country_name'] = sanitize($form['pais']);
        $params['country_code'] = sanitize($form['codigo']);

        $this->save($params);

        return $this->_db->lastID();
    }






}