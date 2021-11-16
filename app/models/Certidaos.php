<?php

class Certidaos extends  Model{


    public function __construct(){
        $table = 'certidaos';
        parent::__construct($table);
    }






    public function saveLast($bi, $type){
        $form['atestado_bi']        = sanitize($bi);
        $form['atestado_type']      = sanitize($type);
        //$form['atestado_state']    = sanitize($params['form__input-2']);

        $this->save($form);
        return $this->_db->lastID();

    }



    public function saveCertidoes($bi, $type){


        if($type == 1){
            return $this->saveLast($bi, $type);

        }elseif($type == 2){

            $Certidaos2 = new Certidaos2();
            return  $Certidaos2->saveLast($bi, $type);


        }elseif($type == 3){
            $Certidaos3 = new Certidaos3();
            return $Certidaos3->saveLast($bi, $type);

        }elseif($type == 4){
            $Certidaos4 = new Certidaos4();
            return $Certidaos4->saveLast($bi, $type);
        }
        return 0;


    }


    public function updateAtestado($bi, $type, $atestado){

        $form['atestado_bi']        = sanitize($bi);
        $form['atestado_type']      = sanitize($type);
        $form['atestado_date'] = sanitize(Date("Y")) . "-".sanitize(Date("m"))."-".sanitize(Date("d"));

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

    public function findAtestado($atestado){







        $query = "SELECT * FROM certidaos
  INNER JOIN certidao_types ON `type_id` = `atestado_type`
 INNER JOIN bis ON `bi_number` = `atestado_bi` AND atestado_id =  ?";

        //dnd($query);
        $results = $this->_db->query($query
            ,
            [$atestado
            ])->results();


        return $results != false ? $results[0] : $results;


    }

    public function findAtestados($pageno, $value = 10, $column = null,$status = null){

        if($status != null && $column != null){
            $status = "  AND " . $column . " = " . $status;
        }




        $no_of_records_per_page = $value;
        $offset = ($pageno-1) * $no_of_records_per_page;


        $query = "SELECT * FROM certidaos
  INNER JOIN certidao_types ON `type_id` = `atestado_type`
 INNER JOIN bis ON `bi_number` = `atestado_bi`
 $status ORDER BY atestado_id DESC
 LIMIT $offset, $no_of_records_per_page";


        //dnd($query);
        return $this->_db->query($query
            ,
            [
            ])->results();


    }

    public function searchAtestados($value){




        $query = "SELECT * FROM certidaos

 INNER JOIN bis ON (`bi_number` = `atestado_bi`)  AND (`atestado_bi` LIKE '%$value%' OR  atestado_id  LIKE '%$value%')
  INNER JOIN certidao_types ON `type_id` = `atestado_type`
 ORDER BY atestado_id DESC";



        //dnd($query);
        return $this->_db->query($query
            ,
            [
            ])->results();


    }




}