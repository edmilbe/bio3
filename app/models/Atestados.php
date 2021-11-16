<?php

class Atestados extends  Model{


    public function __construct(){
        $table = 'atestados';
        parent::__construct($table);
    }








    public function saveAtestado($bi, $type){

        $form['atestado_bi']        = sanitize($bi);
        $form['atestado_type']      = sanitize($type);
        //$form['atestado_state']    = sanitize($params['form__input-2']);

        $this->save($form);

        return $this->_db->lastID();
    }

    public function getAtestadoToPdf($atestado){

        $Meses = new Meses();
        $atestado->atestado_id = $dados['atestado_id'] = $atestado->atestado_id;
        $atestado->ext_atestado_id = $dados['ext_atestado_id'] = NumeroEmExtenso($atestado->atestado_id);
        $atestado_date = $atestado->atestado_date;
        $atestado->atestado_dia = $dados['atestado_dia'] = GetFromStamp($atestado_date, 'd');
        $atestado->ext_atestado_dia = $dados['ext_atestado_dia'] = NumeroEmExtenso(GetFromStamp($atestado_date, 'd'));
        $atestado->atestado_year = $dados['atestado_year'] = GetFromStamp($atestado_date, 'Y');
        $atestado->ext_atestado_year = $dados['atestado_year'] = NumeroEmExtenso(GetFromStamp($atestado_date, 'Y'));
        $atestado->atestado_mes = $dados['atestado_mes'] = $Meses->getName(GetFromStamp($atestado_date, 'm'));

        return $atestado;

    }


    public function updateAtestado($bi, $type, $atestado){

        $form['atestado_bi']        = sanitize($bi);
        $form['atestado_type']      = sanitize($type);
        $form['atestado_date'] = sanitize(Date("Y")) . "-".sanitize(Date("m"))."-".sanitize(Date("d"));
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

    public function getRows(){
        dnd($this->_db->count());
    }





    public function getByBiNAtes($atestado){
        $result = $this->findFirst(['conditions' =>
                [ 'atestado_id = ?'],
                'bind' => [ $atestado]]
        );

        return $result;
    }




    public function findAtestado($atestado){

        $query = "SELECT * FROM atestados
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


        $query = "SELECT * FROM atestados
 INNER JOIN bis ON `bi_number` = `atestado_bi` $status ORDER BY atestado_id DESC
 LIMIT $offset, $no_of_records_per_page";


        //dnd($query);
        return $this->_db->query($query
            ,
            [
            ])->results();


    }

    public function searchAtestados($value){




        $query = "SELECT * FROM atestados

 INNER JOIN bis ON (`bi_number` = `atestado_bi`)  AND (`atestado_bi` LIKE '%$value%' OR  atestado_id  LIKE '%$value%')
  INNER JOIN atestado_types ON `type_id` = `atestado_type`
 ORDER BY atestado_id DESC";



        //dnd($query);
        return $this->_db->query($query
            ,
            [
            ])->results();


    }







}