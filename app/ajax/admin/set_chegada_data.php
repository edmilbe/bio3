
<?php


include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();

$dia = $helper->GetPost('dia');
$mes = $helper->GetPost('mes');
$ano = $helper->GetPost('ano');
$id = $helper->GetPost('id');
if(is_numeric($dia) && is_numeric($mes) && is_numeric($ano) && is_numeric($id)){

    if($dia > 0 && $mes > 0 && $ano > 0 && $id > 0){
        $mes = $mes < 10 ? "0" .$mes : $mes ;
        $dia = $dia< 10 ? "0" .$dia : $dia ;

        $form['shopped_p_chegada'] = "$ano" ."-" . $mes . "-" . "$dia 00:00:00";
        $db->DBUpdate('shopped_prds',$form,"shopped_p_id = $id");
    }

}


?>