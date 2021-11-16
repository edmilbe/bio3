<?php

class Modifics extends  Model{


    public function __construct(){
        $table = 'modifics';
        parent::__construct($table);
    }


    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'modific_id = ?', 'bind'  => [$id]


        ]);



        return $localidade->modific_name;


    }








}