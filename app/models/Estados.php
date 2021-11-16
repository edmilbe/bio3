<?php

class Estados extends  Model{


    public function __construct(){
        $table = 'estados';
        parent::__construct($table);
    }

    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'estado_id = ?', 'bind'  => [$id]


        ]);


        return $localidade;


    }


    public function getEstado($estado){
        $localidade = $this->findFirst([

            'conditions' => 'estado_id = ?', 'bind'  => [sanitize($estado)]


        ]);

        return $localidade->estado_name;

        //$oa = $bi->bi_sexo  == 1 ? "o" : "a";
        //$dados['estado'] = $bi->bi_estado == 1 ? "solteir".$oa : ($bi->bi_estado == 2 ? "casad".$oa: ($bi->bi_estado == 3 ? "divorciad".$oa : ($bi->bi_estado == 4 ? "viuv".$oa: "em comunhão de facto")) );

    }


    public function newSave($form){

        $params['estado_name'] = sanitize($form['estado']);

        $this->save($params);

        return $this->_db->lastID();
    }






}