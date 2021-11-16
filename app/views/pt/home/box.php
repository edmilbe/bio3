

<?php $this->start('body'); ?>
<section class="cont-terceiro shopped-all">
    <?php ?>
    <div class="itens-shopped">
        <div id="itens-shopped">
            <?php
            $totalglobal = 0;
            $totallocal = 0;
            if($this->items != false){
                foreach($this->items as $item){
                    if($item->shopping_p_qt > 0) {
                        ?>
                        <div class="item-shopped">
                            <div class="item-fotodiv">
                                <img src="<?=PROOT?>files/prds/<?=$item->file_name;?>" alt=""
                                     class="item-foto">
                            </div>

                            <form class="shopped-pr">
                                <div class="gp">
                                    <label>Nome:</label>
                                    <span class="item-name"><?=$item->prd_name?></span>
                                </div>

                                <div class="gp">
                                    <label>Marca:</label>
                                    <span class="item-name"><?=$item->marca_name?></span>
                                </div>

                                <div class="gp">
                                    <label>Preço:</label>
                                    <input type="text" readonly class="item-name item-preco" value="<?php
                                    if($item->prd_opc == 1){
                                        echo $item->pr_uni_preco;
                                        $preco = $item->pr_uni_preco;
                                        $totallocal = $preco * $item->shopping_p_qt;
                                    }elseif($item->prd_opc == 2){
                                        echo $item->pr_solto_preco;
                                        $preco = $item->pr_solto_preco;
                                        $totallocal = $preco * $item->shopping_p_qt;
                                    }elseif($item->prd_opc == 3){
                                        echo $item->pr_o_1_preco;
                                        $preco = $item->pr_o_1_preco;
                                        $totallocal = $preco * $item->shopping_p_qt;
                                    }
                                    $totalglobal +=  $totallocal;
                                    ?>
                                            DBS" min="0">
                                </div>

                                <div class="gp">
                                    <label>Qtd:</label>
                                    <input type="number"
                                           id="shopping-pr<?=$item->prd_id?>"
                                           class="item-name item-qt item-preco qt-shopping"
                                           value="<?php echo $item->shopping_p_qt != null ? $item->shopping_p_qt:"0"; ?>"
                                           min="0"
                                           step="<?=$item->prd_escala?>"
                                           onchange="s_from_box(<?=$item->prd_id?>, this.value, <?php echo $preco; ?>)"
                                           readonly
                                        >
                                    <input type="button" value="+" onclick="s_from_box_plus(<?=$item->prd_id?>, this.value, <?php echo $preco; ?>, <?=$item->prd_escala?>);"  class="sinal">
                                    <input type="button" value="-" onclick="s_from_box_minus(<?=$item->prd_id?>, this.value, <?php echo $preco; ?>,  <?=$item->prd_escala?>);" class="sinal">


                                </div>
                                <div class="gp">
                                    <label>Total</label>
                                    <input type="text" id="shopping-tl<?=$item->prd_id?>" readonly class="item-name item-preco" value="<?php echo "$totallocal"; ?> DBS"
                                           min="0">
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                }

            }

            ?>


        </div>
        <div class="item-shopped">
            <form class="shopped-pr">
                <div class="gp">
                    <label>Total</label>
                    <span class="item-name" id="shopping-tg"><?php echo $totalglobal; ?> DBS</span>
                </div>

            </form>
        </div>
        <div class="butoes-box">
            <a href="<?=PROOT?>home/gr1" class="butoes-one">Continuar</a>
            <span onclick="s_clearbox();" class="butoes-one">Limpar o Carrinho</span>
            <a href="<?=PROOT?>home/closebox" class="butoes-one">Pagar</a>
        </div>





        </div>



</section>
<?php $this->end(); ?>



