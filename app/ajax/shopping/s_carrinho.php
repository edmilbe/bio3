
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();

$id_key = false;
$prds = false;
if(!isset($_SESSION['shopping'])){
    $form['shopping_k_key'] = $_SESSION['shopping'] = $helper->KeyGenerator();
    $id_key = $db->DBCreate("shopping_key", $form, true);
    echo "0";
    $form = array();
}else{
    $id_key = $db->DBRead("shopping_key", "where shopping_k_key = '" . $_SESSION['shopping'] ."'");
    if($id_key != false){
        $id_key = $id_key['0']['shopping_k_id'];
    }
}
if(is_numeric($id_key)){
    $prds = $db->DBRead("shopping_prds", "where shopping_p_key = $id_key and shopping_p_qt != 0");

    if($prds != false){

        echo count($prds);
    }else{
        echo "0";
    }

}else{
    $form['shopping_k_key'] = $_SESSION['shopping'] = $helper->KeyGenerator();
    $id_key = $db->DBCreate("shopping_key", $form, true);
    echo "0";
}


