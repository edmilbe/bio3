<?php

class Meses extends  Model{


    public function __construct(){
        $table = 'meses';
        parent::__construct($table);
    }


    public function getName($id){
        $mes = $this->findFirst([

            'conditions' => 'mes_id = ?', 'bind'  => [$id]


        ]);

        if($mes){
            return $mes->mes_name;
        }

        return $mes;
    }








}