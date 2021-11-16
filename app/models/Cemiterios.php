<?php

class Cemiterios extends  Model{


    public function __construct(){
        $table = 'cemiterios';
        parent::__construct($table);
    }


    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'distrito_id = ?', 'bind'  => [$id]


        ]);



        return $localidade->distrito_name;


    }








}