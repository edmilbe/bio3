
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();
$session = $helper->ReturnSession();

$name = $helper->GetPost('v');
$on = $helper->GetPost('on1');
$onon = intval($helper->GetPost('onon1'));






if (is_numeric($on) &&  is_numeric($onon) && $on != 0 && $onon =! 0) {
    $on = $helper->GetPost('on1');
    $onon = intval($helper->GetPost('onon1'));
    $prds = $db->DBInner("
    select
    prd_id,prd_name,marca_name,prd_opc, pr_uni_preco,pr_uni_id,pr_solto_id, pr_solto_preco, pr_solto_id,pr_o_1_preco,med_s.med_name as m0, med_o_1.med_name  as m1, med_o_2.med_name  as m2, med_o_3.med_name  as m3,pr_o_1_qt as q1, pr_o_2_qt as q2, pr_o_3_qt as q3, shopping_p_qt, prd_escala
    from prds inner join pr_group inner join group1 on prd_id = pr_group_pr and pr_group_gr = $on and group1_id = $onon  and  prd_name LIKE '%" . $name ."%'


    left join shopping_key on shopping_k_key = '$session'
 left join shopping_prds on prd_id =  shopping_p_prd and shopping_k_id = shopping_p_key

left join pr_unis on prd_opc = 1 and prd_id = pr_uni_pr
left join pr_solto on prd_opc = 2 and prd_id = pr_solto_pr
left join medidas  as med_s on pr_solto_med = med_s.med_id
left join pr_outros_1 on prd_opc = 3 and prd_id = pr_o_1_pr
left join medidas  as med_o_1 on pr_o_1_med = med_o_1.med_id
left join pr_outros_2 on prd_opc = 3 and prd_id = pr_o_2_pr and pr_o_2_1 = pr_o_1_id
left join medidas  as med_o_2 on pr_o_2_med = med_o_2.med_id
left join pr_outros_3 on prd_opc = 3 and prd_id = pr_o_3_pr and pr_o_3_2 = pr_o_2_id
left join medidas  as med_o_3 on pr_o_3_med = med_o_3.med_id
left join pr_marcas on prd_id = pr_m_pr
left join marcas on marca_id = pr_m_ma
    order by prd_name asc");
}else{

    $prds = $db->DBInner("
    select
    prd_id,prd_name,marca_name,prd_opc, pr_uni_preco,pr_uni_id,pr_solto_id, pr_solto_preco, pr_solto_id,pr_o_1_preco,med_s.med_name as m0, med_o_1.med_name  as m1, med_o_2.med_name  as m2, med_o_3.med_name  as m3,pr_o_1_qt as q1, pr_o_2_qt as q2, pr_o_3_qt as q3, shopping_p_qt, prd_escala
    from prds
  inner join shopping_key on shopping_k_key = '$session' and  prd_name LIKE '%" . $name ."%'
 left join shopping_prds on prd_id =  shopping_p_prd and shopping_k_id = shopping_p_key

left join pr_unis on prd_opc = 1 and prd_id = pr_uni_pr
left join pr_solto on prd_opc = 2 and prd_id = pr_solto_pr
left join medidas  as med_s on pr_solto_med = med_s.med_id
left join pr_outros_1 on prd_opc = 3 and prd_id = pr_o_1_pr
left join medidas  as med_o_1 on pr_o_1_med = med_o_1.med_id
left join pr_outros_2 on prd_opc = 3 and prd_id = pr_o_2_pr and pr_o_2_1 = pr_o_1_id
left join medidas  as med_o_2 on pr_o_2_med = med_o_2.med_id
left join pr_outros_3 on prd_opc = 3 and prd_id = pr_o_3_pr and pr_o_3_2 = pr_o_2_id
left join medidas  as med_o_3 on pr_o_3_med = med_o_3.med_id
left join pr_marcas on prd_id = pr_m_pr
left join marcas on marca_id = pr_m_ma
    order by prd_name asc");

}



if($prds != false){
    ?>
    <div class="itens-shopping">
        <?php
        foreach($prds as $prd){
            ?>
            <div class="item-shopping">
                <div class="item-fotodivs">
                    <a href="view-full.php?on=<?php echo $prd['prd_id'];

                    echo (isset($_GET['on'])) ?  '&onon='.$_GET['on']:'';
                    if(isset($prd['group1_id'])){
                        if($prd['group1_id'] != null){
                            echo '&ononon='.$prd['group1_id'];
                        }
                    }
                    ?>">
                        <img src="files/prds/<?php echo $helper->GetAPFile($prd['prd_id']) ?>" alt="" class="item-pr">
                    </a>
                </div>

                <form class="shopping-pr">
                    <div class="gps">
                        <span class="s-titlo">Nome:</span>
                        <span class="s-item-name n-maior"><?php echo "{$prd['prd_name']}"?></span>
                    </div>
                    <?php
                    if($prd['marca_name'] != null){
                        ?>
                        <span class="s-titlo">Marca:</span>
                        <span class="s-item-name"><?php echo "{$prd['marca_name']}"?></span>

                        <?php
                    }
                    ?>
                    <div class="gps">
                        <span class="s-titlo">Medidas:</span>
                                        <span class="s-item-name"><?php
                                            if($prd['pr_uni_id'] != null){
                                                echo "Unidade";
                                            }elseif($prd['m0'] != null){
                                                echo "{$prd['m0']}";
                                            }else{
                                                echo   $prd['m2'] === null ? "{$prd['m1']}" : $prd['m3'] === null ? "{$prd['m1']} x {$prd['q2']} {$prd['m2']}" : "{$prd['m1']} x {$prd['q2']} {$prd['m2']} x {$prd['q3']} {$prd['m3']}";
                                                //echo "{$prd['m1']}";
                                            }


                                            ?>
                    </div>
                    <div class="gps">
                        <span class="s-titlo">Preco:</span>
                                        <span class="s-item-name"><?php
                                            if($prd['prd_opc'] == 1){
                                                echo "{$prd['pr_uni_preco']}";
                                            }elseif($prd['prd_opc'] == 2){
                                                echo "{$prd['pr_solto_preco']}";
                                            }elseif($prd['prd_opc'] == 3){
                                                echo "{$prd['pr_o_1_preco']}";
                                            }
                                            ?> DBS</span>
                    </div>

                    <div class="gps">
                        <label class="s-titlo">Qtd:</label>
                        <input type="number" id="shopping-pr<?php echo $prd['prd_id'];?>"
                               class="s-item-preco s-item-name qt-shopping"
                               value="<?php echo isset($prd['shopping_p_qt']) ? "{$prd['shopping_p_qt']}":"0"; ?>"
                               min="0"
                               step="<?php echo "{$prd['prd_escala']}";?>" onchange="s_from_main(<?php echo $prd['prd_id'];?>, this.value)" readonly
                            >
                        <input type="button" value="+" onclick="s_from_plus(<?php echo $prd['prd_id'];?>, <?php echo $prd['prd_escala'];?>);"  class="sinal">
                        <input type="button" value="-" onclick="s_from_menos(<?php echo $prd['prd_id'];?>,  <?php echo $prd['prd_escala'];?>);" class="sinal">
                        <input type="button" value="OK" onclick="s_from_okay(<?php echo $prd['prd_id'];?>,  <?php echo $prd['prd_escala'];?>);" class="sinal s-execute">


                    </div>

                </form>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}else{
    ?>
    <div class="itens-shopping">
        <span class="result-busca">Nao Encontrado! :(</span>
    </div>
    <?php
}


