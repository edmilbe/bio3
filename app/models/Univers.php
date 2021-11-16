<?php

class Univers extends  Model{


    public function __construct(){
        $table = 'univers';
        parent::__construct($table);
    }

    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'univer_id = ?', 'bind'  => [$id]


        ]);


        return $localidade;


    }


    public function newSave($form){

        $params['univer_name'] = sanitize($form['univer']);

        $this->save($params);

        return $this->_db->lastID();
    }













}