<?php

class Certidaos3 extends  Model{


    public function __construct(){
        $table = 'certidaos3';
        parent::__construct($table);
    }




    public function saveLast($bi, $type){
        $form['atestado_bi']        = sanitize($bi);
        $form['atestado_type']      = sanitize($type);
        $form['atestado_date'] = sanitize(Date("Y")) . "-".sanitize(Date("m"))."-".sanitize(Date("d"));

        $this->save($form);
        return $this->_db->lastID();

    }



    public function saveCertidoes($bi, $type){


        if($type == 1){
            return $this->saveLast($bi, $type);

        }elseif($type == 2){


        }elseif($type == 3){

        }elseif($type == 4){

        }
        return 0;


    }


    public function updateAtestado($bi, $type, $atestado){

        $form['atestado_bi']        = sanitize($bi);
        $form['atestado_type']      = sanitize($type);
        //$form['atestado_state']    = sanitize($params['form__input-2']);

        $this->update($atestado,$form,'atestado_id');

        return $this->_db->lastID();
    }



    public function getById($bi){
        $result = $this->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [$bi]]
        );

        return $result;
    }



    public function getByBiNAtes($atestado){
        $result = $this->findFirst(['conditions' =>
                [ 'atestado_id = ?'],
                'bind' => [ $atestado]]
        );

        return $result;
    }




    public function findAtestado($pageno, $value = 10, $column = null,$status = null){

        if($status != null && $column != null){
            $status = "  AND " . $column . " = " . $status;
        }


        $no_of_records_per_page = $value;
        $offset = ($pageno-1) * $no_of_records_per_page;



        return $this->_db->query("SELECT * FROM atestados

 INNER JOIN bis ON `bi_number` = `atestado_bi` $status ORDER BY atestado_id DESC
 LIMIT $offset, $no_of_records_per_page

        "
            ,
            [
            ])->results();







    }










}