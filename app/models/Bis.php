<?php

class Bis extends  Model{


    public function __construct(){
        $table = 'bis';
        parent::__construct($table);
    }




    public function getByToPDF($bi){

        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();

        $bi->bi_number = $dados['bi_number'] = $bi->bi_number;
        $bi->ext_bi_number = $dados['bi_number'] = NumeroEmExtenso($bi->bi_number);




        $bi->bi_name = $dados['bi_name'] = '<span class="name">' . $bi->bi_name. '</span>';
        $bi->bi_pai = $dados['bi_pai'] = '<span class="name">' .$bi->bi_pai . '</span>';
        $bi->bi_mae = $dados['bi_mae'] = '<span class="name">' . $bi->bi_mae . '</span>';
        $bi->bi_nasc_dia = $dados['bi_nasc_dia'] = $bi->bi_nasc_dia;
        $bi->ext_bi_nasc_dia = $dados['ext_bi_nasc_dia'] = NumeroEmExtenso($bi->bi_nasc_dia);
        $bi->bi_nasc_mes = $dados['bi_nasc_mes'] = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_ano = $dados['bi_nasc_ano'] = $bi->bi_nasc_ano;
        $bi->ext_bi_nasc_ano = $dados['ext_bi_nasc_ano'] = NumeroEmExtenso($bi->bi_nasc_ano);

        /*
         *
         * $bi_dis =
        $Localidades->getName($bi->bi_nasc_loc)->localidade_dist;
        $bi->bi_nasc_pais = $Localidades->getPaisName($bi->bi_nasc_loc);

        $bi->bi_nasc_dist = $dados['bi_nasc_dist'] = $Distritos->getName($bi_dis)->distrito_name;
        $bi->bi_nasc_loc = $dados['bi_nasc_loc'] = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;


         * */



        $bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc);
        $bi_nasc_dis = $bi_nasc_loc->localidade_dist;


        $bi->bi_nasc_loc = $bi_nasc_loc->localidade_name;

        $bi->bi_nasc_dist = $Distritos->getName($bi_nasc_dis)->distrito_name;

        $Countries = new Countries();
        $bi->bi_nasc_pais = $Countries->getName($Distritos->getName($bi_nasc_dis)->distrito_pais)->country_name;


        if($bi->bi_nasc_pais == "São Tomé e Príncipe"){
            $bi->bi_nasc_loc = $bi->bi_nasc_loc . ", Distrito de " . $bi->bi_nasc_dist . ", São Tomé";

        }else{
            $bi->bi_nasc_loc = $bi->bi_nasc_loc . ", " . $bi->bi_nasc_pais;

        }




        $bi->bi_emi_dia =  $dados['bi_emi_dia'] = $bi->bi_emi_dia;
        $bi->ext_bi_emi_dia =  $dados['ext_bi_emi_dia'] = NumeroEmExtenso($bi->bi_emi_dia);
        $bi->bi_emi_mes =  $dados['bi_emi_mes'] = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_emi_ano =  $dados['bi_emi_ano'] = $bi->bi_emi_ano;
        $bi->ext_bi_emi_ano = $dados['ext_bi_emi_ano'] = NumeroEmExtenso($bi->bi_emi_ano);

        $bi->bi_filho =  $dados['filho'] = $bi->bi_sexo == 1 ? "filho" : "filha";
        $bi->bi_nascido =  $dados['nascido'] = $bi->bi_sexo == 1 ? "nascido" : "nascida";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";





        $bi->bi_estado = $bi->bi_estado == 1 ? "solteir".$oa:($bi->bi_estado == 2 ? "casad".$oa:($bi->bi_estado == 3 ? "divociad".$oa:($bi->bi_estado == 4 ? "viúv".$oa:("em comunhão de factos"))));




        $Documentos = new Documentos();
        $ona = $bi->bi_sexo  == 1 ? "" : "a";
        $bi->bi_documento = "portador" . $ona . " do " . $Documentos->getName($bi->bi_documento)->documento_name;
        $trata = $bi->trata = "senhor".$ona;



        $Entidades = new Entidades();
        $bi->bi_emi_entidade =  $Entidades->getName($bi->bi_local_emi)->entidade_name;

        //Numero 4 - Bolsa Interna

        return $bi;
    }


    public function saveBI($params){
        $form['bi_documento']      = sanitize($params['documento']);
        $form['bi_local_emi']      = sanitize($params['entidade']);
        $form['bi_number']      = sanitize($params['bi']);
        $form['bi_name']        = sanitize($params['name']);
        $form['bi_pai']         = sanitize($params['pai']);
        $form['bi_mae']         = sanitize($params['mae']);
        $form['bi_nasc_dia']    = sanitize($params['nas-dia']);
        $form['bi_nasc_mes']    = sanitize($params['nas-mes']);
        $form['bi_nasc_ano']    = sanitize($params['nas-ano']);
        $form['bi_nasc_loc']    = sanitize($params['nature']);
        $form['bi_sexo']    = sanitize($params['genero']);
        $form['bi_emi_dia']     = sanitize($params['emissao-dia']);
        $form['bi_emi_mes']     = sanitize($params['emissao-mes']);
        $form['bi_emi_ano']     = sanitize($params['emissao-ano']);
        $form['bi_sexo']     = sanitize($params['genero']);


        $form['bi_estado']      = sanitize($params['estado']);
        $this->save($form);

        return $this->_db->lastID();


    }


    public function getByBi($bi){
        $result = $this->findFirst(['conditions' =>
                ['bi_number = ?'],
                'bind' => [$bi]]
        );

        return $result;
    }


    public function getBIFull($bi){

        $result = $this->_db->query(
            "SELECT * FROM bis

JOIN localidades l 	ON bi_nasc_loc = l.localidade_id AND bi_number = ?
JOIN meses m 	ON bi_nasc_mes = m.mes_id
JOIN meses m2 	ON bi_emi_mes = m2.mes_id", [$bi])->results();

        if($result){
            return $result[0];
        }

        return $result;
    }
    public function getBIById($id){

        $result = $this->_db->query(
            "SELECT * FROM bis

JOIN localidades l 	ON bi_nasc_loc = l.localidade_id AND bi_id = ?
JOIN meses m 	ON bi_nasc_mes = m.mes_id
JOIN meses m2 	ON bi_emi_mes = m2.mes_id", [sanitize($id)])->results();

        if($result){
            return $result[0];
        }

        return $result;
    }


    public function updateBI($params, $bi){
        //dnd($_POST);
        $form['bi_documento']      = sanitize($params['documento']);
        $form['bi_local_emi']      = sanitize($params['entidade']);
        $form['bi_number']      = sanitize($params['bi']);
        $form['bi_name']        = sanitize($params['name']);
        $form['bi_pai']         = sanitize($params['pai']);
        $form['bi_mae']         = sanitize($params['mae']);
        $form['bi_nasc_dia']    = sanitize($params['nas-dia']);
        $form['bi_nasc_mes']    = sanitize($params['nas-mes']);
        $form['bi_nasc_ano']    = sanitize($params['nas-ano']);
        $form['bi_nasc_loc']    = sanitize($params['nature']);
        $form['bi_sexo']    = sanitize($params['genero']);
        $form['bi_emi_dia']     = sanitize($params['emissao-dia']);
        $form['bi_emi_mes']     = sanitize($params['emissao-mes']);
        $form['bi_emi_ano']     = sanitize($params['emissao-ano']);
        $form['bi_sexo']     = sanitize($params['genero']);


        $form['bi_estado']      = sanitize($params['estado']);
        $this->update($bi, $form, 'bi_id');

        return $this->_db->lastID();
    }

    public function findBI($value){

        $Query = "

        ";
       return $this->_db->query("SELECT * FROM bis WHERE `bi_number` LIKE  '%$value' OR `bi_number` LIKE  '$value%' OR `bi_number` LIKE  '%$value%'

        OR `bi_name` LIKE  '%$value' OR `bi_name` LIKE  '$value%' OR `bi_name` LIKE  '%$value%'",[
        ])->results();
    }









}