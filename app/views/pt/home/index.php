

<?php $this->start('body'); ?>
<section class="cont-terceiro">
    <div class="itens-check">
        <form class="bsc-form">
            <input type="text" id="buscar-pr" onkeyup="s_search_pr();" placeholder="Nome do Item" class="buscaca-main">
        </form>
    </div>
    <script>
        function s_search_pr(){
            var on1 = <?=$this->on?>;
            var onon1 = <?=$this->onon?>;


            //alert(on1 +" "+ onon1);/*
            var v = document.getElementById("buscar-pr").value;
            if(v == ''){
                v = 'xxx';
            }

            $.post("ajax/ssearchpr/"+v+"/"+on1+"/"+onon1,{v:v, on1:on1, onon1:onon1},function(data){
                $("#itens-shopping").html(data);
            });
        }
    </script>
</section>
<section class="cont-terceiro shopping" id="section">
    <?php ?>
    <?php
    if($this->items != false){
        ?>
        <div class="itens-shopping" id="itens-shopping">
            <?php
            foreach($this->items as $item){
                ?>
                <div class="item-shopping item-min">
                    <div class="item-fotodivs fotodivs-min">

                        <a href="<?=PROOT?>home/viewfull/<?=$item->prd_id?>">
                            <img src="<?=PROOT?>files/prds/<?=$item->file_name;?>" alt="" class="item-pr">
                        </a>
                    </div>
                    <div class="gps">
                        <span class="s-titlo">Nome:</span>
                        <span class="s-item-name n-maior"><?=$item->prd_name?></span>
                    </div>

                    <form class="shopping-pr shopping-min">

                        <?php
                        if($item->marca_name != null){
                            ?>
                            <span class="s-titlo">Marca:</span>
                            <span class="s-item-name"><?=$item->marca_name?></span>

                            <?php
                        }
                        ?>

                        <div class="gps">
                            <span class="s-titlo">Preço:</span>
                                        <span class="s-item-name"><?php
                                            if($item->prd_opc == 1){
                                                echo $item->pr_uni_preco;
                                            }elseif($item->prd_opc == 2){
                                                echo $item->pr_solto_preco;
                                            }elseif($item->prd_opc == 3){
                                                echo $item->pr_o_1_preco;
                                            }
                                            ?> DBS</span>
                        </div>
                        <div class="gps">
                            <span class="s-titlo">Medidas:</span>
                                        <span class="s-item-name"><?php
                                            if($item->pr_uni_id != null){
                                                echo "Unidade";
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
                            <label class="s-titlo">Qtd:</label>
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
            ?>
        </div>
        <?php
    }

    ?>
</section>
<?php $this->end(); ?>

<?php $this->start('bfooter') ?>
<div class="butoes-all">
    <?php

    if (($this->on != 0) &&  ($this->onon != 0)) {
        ?>
        <a href="<?=PROOT?>home/gr2/<?=$this->g1->group1_id;?>" class="butoes-one"><?=$this->g1->group1_name;?></a>
        <?php
    }else{
        ?>
        <a href="<?=PROOT?>home/gr2" class="butoes-one">Grupos 2</a>
        <?php

    }
    ?>

    <?php




    ?>
    <a href="<?=PROOT?>home/gr1" class="butoes-one">Grupos Iniciais</a>
    <a href="<?=PROOT?>home/index" class="butoes-one">Todos</a>

</div>

<?php $this->end();?>
