<?php

class Agendas extends  Model{


    public function __construct(){
        $table = 'agendas';
        parent::__construct($table);
    }


    public function newAgenda($params){
        $form['agenda_dia'] = sanitize($params['dia']);
        $form['agenda_mes'] = sanitize($params['mes']);
        $form['agenda_ano'] = sanitize($params['ano']);
        $form['agenda_complete'] = sanitize($params['ano']) . "-".sanitize($params['mes'])."-".sanitize($params['dia']);
        $form['agenda_title'] = sanitize($params['titlo']);

        $this->save($form);
        return $this->_db->lastID();
    }








}