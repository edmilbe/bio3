<?php

class Ajax extends  Controller implements InterfaceAjax{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }


    public function scarrinhoAction(){


        $id_key = false;
        $prds = false;
        $sk = new ShoppingKey();



        if(!Session::exists('shopping')){
            $id_key = $sk->NewShoppingKey();
            echo "0";
        }else{
            $id_key = $sk->GetIdKey();
        }
        if(is_numeric($id_key) != null){
            $sp = new ShoppingPrds();
            $prds = $sp->find(
                [
                    'conditions' =>
                        [
                            'shopping_p_key = ?',
                            'shopping_p_qt != ?'
                        ],

                    'bind' =>  [
                        $id_key, 0
                    ]
                ]);

            echo count($prds);

            //$prds = $db->DBRead("shopping_prds", "where shopping_p_key = $id_key and shopping_p_qt != 0");

            //$sp->rows();

        }else{
            $id_key = $sk->NewShoppingKey();
            echo "0";
        }
    }

    public function schangeAction($pr){

        $id_key = false;
        $sk = new ShoppingKey();

        if(is_numeric($pr)){
            $spo = new ShoppingPrds();
            echo $spo->setItems($pr);
        }
    }

    public function stlAction($pr, $vl, $preco){
        if(is_numeric($vl) && is_numeric($preco)){
            echo ($vl * $preco);

        }
    }
    public function sclearAction(){
        $sk = new ShoppingKey();

        $id_key = $sk->NewShoppingKey();
    }
    public function stgAction(){
        $prds = new Prds();
        $items = $prds->box();


        $totalglobal = 0;
        $totallocal = 0;
        $moeda = MOEDA;
        if($items != false){
            foreach($items as $item){
                if($item->prd_opc == 1){
                    //echo $item->pr_uni_preco;
                    $preco = $item->pr_uni_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                }elseif($item->prd_opc == 2){
                    //echo $item->pr_solto_preco;
                    $preco = $item->pr_solto_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                }elseif($item->prd_opc == 3){
                    //echo $item->pr_o_1_preco;
                    $preco = $item->pr_o_1_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                }
                $totalglobal +=  $totallocal;
            }
        }
        ?>
        <?=$totalglobal?>
        <?php

    }

    public function ssearchprAction($name, $on = 0, $onon = 0)
    {
        $name = sanitize($name);
        $on = sanitize(is_numeric($on) ? $on : 0);
        $onon = sanitize(is_numeric($onon) ? $onon : 0);

        $sp = new ShoppingPrds();

        $prds = $sp->findByName($name, $on, $onon);

        $g1 = new Group1();

        //$gps = $g1->findFirst(['conditions' => 'group1_id = ?', 'bind' => $onon]);
        if($prds != false){

            foreach($prds as $item){
                ?>
                <div class="item-shopping item-min">
                    <div class="item-fotodivs fotodivs-min">

                        <a href="<?=PROOT?>home/viewfull/<?php echo $item->prd_id;

                        echo ($on != 0) ?  '/'.$on:'';
                        if(isset($item->group1_id)){
                            if($item->group1_id){
                                echo '/'.$item->group1_id;
                            }
                        }
                        ?>">
                            <img src="<?=PROOT?>files/prds/<?=$item->file_name;?>" alt="" class="item-pr">
                        </a>
                    </div>
                    <div class="gps">
                        <span class="s-item-name n-maior"><?=$item->prd_name?></span>
                    </div>
                    <form class="shopping-pr shopping-min">

                        <?php
                        if($item->marca_name != null){
                            ?>
                            <span class="s-titlo">Mark:</span>
                            <span class="s-item-name"><?=$item->marca_name?></span>

                            <?php
                        }
                        ?>

                        <div class="gps">
                            <span class="s-titlo">Price:</span>
                                        <span class="s-item-name"><?php
                                            if($item->prd_opc == 1){
                                                echo $item->pr_uni_preco;
                                            }elseif($item->prd_opc == 2){
                                                echo $item->pr_solto_preco;
                                            }elseif($item->prd_opc == 3){
                                                echo $item->pr_o_1_preco;
                                            }

                                            ?><?=MOEDA?></span>
                        </div>
                        <div class="gps">
                            <span class="s-titlo">Measure:</span>
                                        <span class="s-item-name"><?php
                                            if($item->pr_uni_id != null){
                                                echo "Bu Item";
                                            }elseif($item->m0 != null){
                                                echo $item->m0;
                                            }else{
                                                echo   $item->m2 === null ? $item->m1
                                                    : $item->m3 === null ? $item->m1 . " x " . $item->q2 ." " . $item->m2
                                                        : $item->m1 . " x " . $item->q2  . " x " .  $item->m2 . " x " . $item->q3 . " x " . $item->m3;
                                                //echo "{$prd['m1']}";
                                            }


                                            ?>
                        </div>
                        <div class="gps">
                            <label class="s-titlo">Qty:</label>
                            <input type="number" id="shopping-pr<?=$item->prd_id?>"
                                   class="s-item-preco s-item-name qt-shopping"
                                   value="<?php echo $item->shopping_p_qt != null ? $item->shopping_p_qt:"0"; ?>"
                                   min="0"
                                   step="<?=$item->prd_escala?>" onchange="s_from_main(<?=$item->prd_id?>, this.value)" readonly
                                >
                            <input type="button" value="+" onclick="s_from_plus(<?=$item->prd_id?>, <?=$item->prd_escala?>);"  class="sinal">
                            <input type="button" value="-" onclick="s_from_menos(<?=$item->prd_id?>,  <?=$item->prd_escala?>);" class="sinal">
                            <input type="button" value="OK" onclick="s_from_okay(<?=$item->prd_id?>,  <?=$item->prd_escala?>);" class="sinal s-execute">


                        </div>

                    </form>
                </div>

                <?php
            }

        }
        ?>
        <script>
            minproduct();
        </script>
        <?php



    }

    public function ssearchgr1Action($name){
        $name = sanitize($name);


        $prds = new Group1();

        $items = $prds->getByNameGr1($name);

        if($items != false){
            ?>
            <div class="itens-shopping">
                <?php
                foreach($items as $gr){

                    ?>
                    <a href="<?=PROOT?>home/gr2/<?=$gr->group1_id?>" class="item-shopping item-min">
                        <div class="item-fotodivs fotodivs-min">

                            <img src="<?=PROOT?>files/grupo1/<?=$gr->file_name;?>" alt="" class="item-pr">

                        </div>
                        <div class="gps all-center">
                            <span class="s-item-name n-maior "><?=$gr->group1_name?></span>
                        </div>
                        <div class="shopping-pr shopping-min">

                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        <script>
            minproduct();
        </script>
        <?php

    }
    public function ssearchgr2Action($name, $gr1 = 0){
        $name = sanitize($name);
        $gr1 = sanitize($gr1);

        $prds = new Group2();

        $items = $prds->getByNameGr2($name, $gr1);

        if($items != false){
            ?>
            <div class="itens-shopping">
                <?php
                foreach($items as $gr){

                    ?>
                    <a href="<?=PROOT?>home/index/<?=$gr->group2_id?>/<?=$gr->group1_id?>" class="item-shopping item-min">
                        <div class="item-fotodivs fotodivs-min">

                            <img src="<?=PROOT?>files/grupo2/<?=$gr->file_name;?>" alt="" class="item-pr">

                        </div>
                        <div class="gps all-center">
                            <span class="s-item-name n-maior "><?=$gr->group2_name?></span>
                        </div>
                        <div class="shopping-pr shopping-min">

                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        <script>
            minproduct();
        </script>
        <?php


    }

    public function isemailAction($email){
        $email = sanitize($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    public function existsemailAction($email){

        $email = sanitize($email);
        $m = new EmailsUser();

        if($m->emailExistis($email)){
            return true;
        }
        return false;
    }

    public function getcompraAction($name = 0){
        $sek = new ShoppedKey();
        if($name != 0) {
            $prds = $sek->getCompra($name);
        }else{
            $prds = $sek->getOpened();

        }
        if($prds != false) {
            ?>
            <div class="itens-shopped">
                <?php
                foreach ($prds as $prd) {
                    ?>
                    <div class="item-shopped">


                        <!--
                        <div class="item-fotodiv">
                            <img src="pic/ananas.jpg" alt="" class="item-foto">
                        </div>
                        -->
                        <form class="shopped-pr">
                            <div class="gp">
                                <label>Status</label>

                                <span class="item-name">Pendente</span>
                            </div>
                            <div class="gp">
                                <label>Compra</label>

                                <span class="item-name"><?= $prd->shopped_k_id; ?></span>
                            </div>
                            <div class="gp">
                                <label>Qtd. Produto</label>
                                <span class="item-name"><?= $prd->total; ?></span>
                            </div>
                            <a href="<?= PROOT ?>shopped/statusordered/<?= $prd->shopped_k_id; ?>" class="butoes-one">Ver</a>
                            <a target="_blank" href="../files/facturas/<?= $prd->shopped_k_fac; ?>" class="butoes-one">Factura</a>
                        </form>
                    </div>
                    <?php
                }
                ?>

            </div>
            <?php
        }


    }

    public function setchegadadataAction($dia, $mes, $ano, $id){
        $sep = new ShoppedPrds();

        $sep->updateChegada($dia, $mes, $ano, $id);

    }



}