
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();
$marcas = $prds = false;
$session = $helper->ReturnSession();


$prds = $db->DBInner("
    select *from prds
  inner join shopping_key on shopping_k_key = '$session'
 inner join shopping_prds on prd_id =  shopping_p_prd and shopping_k_id = shopping_p_key

left join pr_unis on prd_opc = 1 and prd_id = pr_uni_pr
left join pr_solto on prd_opc = 2 and prd_id = pr_solto_pr
left join pr_outros_1 on prd_opc = 3 and prd_id = pr_o_1_pr
left join pr_outros_2 on prd_opc = 3 and prd_id = pr_o_2_pr and pr_o_2_1 = pr_o_1_id
left join pr_outros_3 on prd_opc = 3 and prd_id = pr_o_3_pr and pr_o_3_2 = pr_o_2_id
left join pr_marcas on prd_id = pr_m_pr
left join marcas on marca_id = pr_m_ma
    order by prd_name asc");

$totalglobal = 0;
$totallocal = 0;
if($prds != false){
    foreach($prds as $prd){
        $totallocal = 0;
        if($prd['shopping_p_qt'] > 0) {
            if ($prd['prd_opc'] == 1) {
                $preco = $prd['pr_uni_preco'];
                $totallocal = $prd['pr_uni_preco'] * $prd['shopping_p_qt'];
            } elseif ($prd['prd_opc'] == 2) {
                $totallocal = $prd['pr_solto_preco'] * $prd['shopping_p_qt'];
                $preco = $prd['pr_solto_preco'];
            } elseif ($prd['prd_opc'] == 3) {
                $preco = $prd['pr_o_1_preco'];
                $totallocal = $prd['pr_o_1_preco'] * $prd['shopping_p_qt'];
            }
        }
        $totalglobal += $totallocal;
    }

}
echo "$totalglobal" . " DBS";

