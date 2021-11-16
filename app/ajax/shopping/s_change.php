
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();

$vl = $helper->GetPost("vl");
$pr = $helper->GetPost("pr");
$id_key = false;
if(is_numeric($vl) && is_numeric($pr)){
    if(!isset($_SESSION['shopping'])){
        $form['shopping_k_key'] = $_SESSION['shopping'] = $helper->KeyGenerator();
        $id_key = $db->DBCreate("shopping_key", $form, true);
        $form = array();


    }else{
        $id_key = $db->DBRead("shopping_key", "where shopping_k_key = '" . $_SESSION['shopping'] ."'");
        if($id_key != false){
            $id_key = $id_key['0']['shopping_k_id'];
        }
    }
    if($db->DBRead("prds", "where prd_id = $pr limit 1")!= false and $id_key != false){
        $prds = $db->DBRead("shopping_prds", "where shopping_p_prd = $pr  and shopping_p_key = $id_key limit 1");
        if($prds === false){
            $form['shopping_p_key'] = $id_key;
            $form['shopping_p_prd'] = $pr;
            $form['shopping_p_qt']  = $vl;
            $db->DBCreate("shopping_prds", $form, true);
            $form = array();
        }else{
            $form['shopping_p_key'] = $id_key;
            $form['shopping_p_prd'] = $pr;
            $form['shopping_p_qt']  = $vl;
            $db->DBUpdate("shopping_prds", $form, "shopping_p_prd = $pr and shopping_p_key = $id_key");
            $form = array();
        }
        echo true;
    }

}else{
    echo false;
}