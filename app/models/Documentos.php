<?php

class Documentos extends  Model{


    public function __construct(){
        $table = 'documentos';
        parent::__construct($table);
    }

    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'documento_id = ?',
            'bind'  => [$id]


        ]);


        return $localidade;


    }


    public function newSave($form){

        $params['documento_name'] = sanitize($form['documento']);

        $this->save($params);

        return $this->_db->lastID();
    }






}