
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();

$vl = $helper->GetPost("vl");
$pr = $helper->GetPost("pr");
$preco = $helper->GetPost("preco");

if(is_numeric($vl) and is_numeric($preco)){
    echo ($vl * $preco);
}
