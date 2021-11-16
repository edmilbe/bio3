
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();


$form['shopping_k_key'] = $_SESSION['shopping'] = $helper->KeyGenerator();
$id_key = $db->DBCreate("shopping_key", $form, true);

