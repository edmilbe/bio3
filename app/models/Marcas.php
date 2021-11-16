<?php

class Marcas extends  Model{


    public function __construct(){
        $table = 'marcas';
        parent::__construct($table);
    }

    public function getMarcas($active = -1){
        if($active == -1){
            return $this->find([]);
        }else{
            return $this->find(['conditions' => ['marca_active = ?'], 'bind' => [$active]]);
        }
    }

    public function saveMarca($nome){
        $form['marca_name'] = sanitize($nome);
        $this->save($form);

        if($this->_db->lastID() > 0){
            return true;
        }
        return false;

    }


}