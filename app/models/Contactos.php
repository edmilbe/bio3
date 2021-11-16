<?php

class Contactos extends  Model{


    public function __construct(){
        $table = 'contactos';
        parent::__construct($table);
    }

    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'contacto_id = ?', 'bind'  => [$id]


        ]);


        return $localidade;


    }













}