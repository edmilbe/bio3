<?php

class Localidades extends  Model{


    public function __construct(){
        $table = 'localidades';
        parent::__construct($table);
    }

    public function getName($id){
        $localidade = $this->findFirst([

            'conditions' => 'localidade_id = ?', 'bind'  => [$id]


        ]);


        return $localidade;


    }

    public function getPaisName($loc_id){
        $Countries = new Countries();
        $Distritos = new Distritos();

        return $Countries->getName($Distritos->getName($this->getName($loc_id)->localidade_dist)->distrito_pais)->country_name;





        // return $Countries->getName($this->getName($dist)->dist_pais)->country_name;


    }



    public function newSave($form){

        $params['localidade_name'] = sanitize($form['localidade']);
        $params['localidade_dist'] = sanitize($form['distrito']);

        $this->save($params);

        return $this->_db->lastID();
    }













}