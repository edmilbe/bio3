

<?php $this->start('body'); ?>

<section class="cont-terceiro check-item">

    <div class="itens-check">
        <?php
        if($this->item != false){

            ?>
            <div class="item-check">
                <div class="pegado">
                    <?php
                    ?>
                    <div class="item-fotodivc">
                        <img src="<?=PROOT?>files/prds/<?=$this->item->file_name?>" alt="" class="item-ch">
                    </div>
                    <div class="item-fotodivc-all">
                        <?php
                        $cont = 0;
                        foreach($this->fotos as $ft) {

                            ?>
                            <img src="<?=PROOT?>files/prds/<?=$ft->file_name?>" alt="" class="foto-min" onclick="img_full(<?=$cont;?>);">

                            <?php
                            $cont++;
                        }
                        ?>
                    </div>

                </div>
                <script>
                   function img_full(pos){

                      document.getElementsByClassName('item-ch')[0].src = document.getElementsByClassName('foto-min')[pos].src;
                   }
                </script>
                <form class="check-pr">
                    <div class="gpc">
                        <span class="c-titlo">Nome:</span>
                        <span class="c-item-name n-maior"><?=$this->item->prd_name?></span>
                    </div>
                    <div class="gpc">
                        <?php
                        if($this->item->marca_name != null){
                            ?>
                            <span class="c-titlo">Marca:</span>
                            <span class="c-item-name"><?=$this->item->marca_name?></span>
                            <?php
                        }

                        ?>

                    </div>
                    <div class="gpc">
                        <span class="c-titlo">Preco:</span>
                                    <span class="c-item-name">
                                        <?php
                                        if($this->item->prd_opc == 1){
                                            echo $this->item->pr_uni_preco;
                                        }elseif($this->item->prd_opc == 2){
                                            echo $this->item->pr_solto_preco;
                                        }elseif($this->item->prd_opc == 3){
                                            echo $this->item->pr_o_1_preco;
                                        }
                                        ?>

                                    </span>
                    </div>
                    <div class="gpc">
                        <span class="c-titlo">Medidas:</span>
                                        <span class="c-item-name"><?php
                                            if($this->item->pr_uni_id != null){
                                                echo "Unidade";
                                            }elseif($this->item->m0 != null){
                                                echo $this->item->m0;
                                            }else{
                                                echo   $this->item->m2 === null ? $this->item->m1
                                                    : $this->item->m3 === null ? $this->item->m1 . " x " . $this->item->q2 ." " . $this->item->m2
                                                        : $this->item->m1 . " x " . $this->item->q2  . " x " .  $this->item->m2 . " x " . $this->item->q3 . " x " . $this->item->m3;
                                                //echo "{$prd['m1']}";
                                                //echo "{$prd[0]['m1']}";
                                            }


                                            ?>
                    </div>


                    <div class="gpc">
                        <label class="s-titlo">Qtd:</label>
                        <input type="number" id="shopping-pr<?=$this->item->prd_id?>"
                               class="s-item-preco s-item-name qt-shopping"
                               value="<?php echo $this->item->shopping_p_qt != null ? $this->item->shopping_p_qt:"0"; ?>"
                               min="0"
                               step="<?=$this->item->prd_escala?>"
                            >
                        <input type="button" value="+" onclick="s_from_plus(<?=$this->item->prd_id?>, <?=$this->item->prd_escala?>);"  class="sinal">
                        <input type="button" value="-" onclick="s_from_menos(<?=$this->item->prd_id?>,  <?=$this->item->prd_escala?>);" class="sinal">
                        <input type="button" value="OK" onclick="s_from_okay(<?=$this->item->prd_id?>,  <?=$this->item->prd_escala?>);" class="sinal s-execute">


                    </div>
                    <?php

                    /*
                     *
                     *
                     *                                 <input type="button" class="butoes-one" onclick="s_from_full(<?php echo $prd[0]['prd_id'];?>)" value="Adicionar ao Carrinho" min="0">
*/

                    ?>
                </form>
            </div>

            <?php
        }
        ?>
    </div>

</section>
<?php $this->end(); ?>

<?php $this->start('bfooter') ?>

<div class="butoes-all">
    <?php
    foreach($this->gps as $g1){
        ?>
        <a href="<?=PROOT?>home/gr2/<?=$g1->group1_id;?>" class="butoes-one"><?=$g1->group1_name;?></a>
        <?php
    }
    ?>
    <a href="<?=PROOT?>home/gr1" class="butoes-one">Grupos Iniciais</a>
    <a href="<?=PROOT?>home/index" class="butoes-one">Todos</a>

</div>
<?php $this->end(); ?>

