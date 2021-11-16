
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();
$session = $helper->ReturnSession();

$name = $helper->GetPost('v');
$prds = $db->DBInner("select shopped_k_id, shopped_k_key, count(shopped_p_id) as total from shopped_key  inner join shopped_prds
on shopped_k_id = shopped_p_key   and shopped_k_id = $name group by shopped_k_id");



if($prds != false){
    ?>
    <div class="itens-shopped">
        <?php
        foreach($prds as $prd){
            ?>
            <div class="item-shopped">




                <form class="shopped-pr">
                    <div class="gp">
                        <label>Status</label>

                        <span class="item-name">Pendente</span>
                    </div>
                    <div class="gp">
                        <label>Compra</label>

                        <span class="item-name"><?php echo "{$prd['shopped_k_id']}"; ?></span>
                    </div>
                    <div class="gp">
                        <label>Qtd. Produto</label>
                        <span class="item-name"><?php echo "{$prd['total']}"; ?></span>
                    </div>
                    <a target="_blank" href="admin-status-shopped.php?on=<?php echo "{$prd['shopped_k_id']}"; ?>" class="butoes-one">Analizar</a>
                    <a target="_blank" href="views/facturas_compra/<?php echo "{$prd['shopped_k_key']}".".pdf"; ?>" class="butoes-one">Factura</a>
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


