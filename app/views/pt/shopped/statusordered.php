

<?php $this->start('body'); ?>

<section class="cont-terceiro shopping" id="section">
    <span class="title-form"><?=$this->notfound?></span>

    <?php
    if($this->items != false){
        ?>
        <div class="itens-shopping">
            <?php
            foreach($this->items as $item){
                ?>
                <div class="item-shopping">
                    <div class="item-fotodivs">


                            <img src="<?=PROOT?>files/prds/<?=$item->file_name;?>" alt="" class="item-pr">

                    </div>

                    <form class="shopping-pr" method="post" action="<?=PROOT?>shopped/pendent/<?=$item->shopped_p_id;?>/<?=$item->shopped_p_key;?>">
                        <div class="gps">
                            <span class="s-titlo">Nome:</span>
                            <span class="s-item-name n-maior"><?=$item->prd_name?></span>
                        </div>
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
                                            echo $item->shopped_p_prc * $item->shopped_p_qt; ?> DBS</span>
                        </div>

                        <div class="gpc">
                            <span class="juntos">

                                    <?php


                                    $d = GetFromStamp($item->shopped_p_chegada,"d");
                                    $m = GetFromStamp($item->shopped_p_chegada,"m");
                                    $y = GetFromStamp($item->shopped_p_chegada,"Y");

                                    if($this->dias != false && $this->meses != false && $this->anos != false){
                                        //var_dump($item->shopped_p_id);
                                        ?>
                                        <select class="dia-c" onchange="set_chegada_data(<?=$item->shopped_p_id;?>);" id="dia-c<?=$item->shopped_p_id?>">
                                            <option value="0">Dia</option>
                                            <?php
                                            foreach($this->dias as $dia){
                                                ?>
                                                <option value="<?=$dia->dia_name;?>" class="bold" <?php echo ($dia->dia_name == $d && $item->shopped_p_chegada != "1999-12-31 21:00:00") ? "selected":"";?>><?=$dia->dia_name;?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                        <select class="mes-c" onchange="set_chegada_data(<?=$item->shopped_p_id;?>);" id="mes-c<?=$item->shopped_p_id;?>">
                                            <option value="0">Mes</option>
                                            <?php
                                            foreach($this->meses as $mes){
                                                ?>
                                                <option value="<?=$mes->mes_id;?>" class="bold" <?php echo ($mes->mes_id == $m && $item->shopped_p_chegada != "1999-12-31 21:00:00") ? "selected":"";?>><?=$mes->mes_name;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <select class="ano-c" onchange="set_chegada_data(<?=$item->shopped_p_id?>);" id="ano-c<?=$item->shopped_p_id?>">
                                            <option value="0">Anos</option>
                                            <?php
                                            foreach($this->anos as $ano){
                                                ?>
                                                <option value="<?=$ano->ano_name;?>" class="bold" <?php echo ($ano->ano_name == $y && $item->shopped_p_chegada != "1999-12-31 21:00:00") ? "selected":"";?>><?=$ano->ano_name;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </span>
                        </div>
                        <?php
                        if($item->shopped_p_chegada != "1999-12-31 21:00:00"):
                            ?>
                            <div class="gpc bsc-form" >
                                <input type="submit" value="Pendente" class="butoes-one">
                            </div>
                            <?php
                        endif;
                        ?>

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

<div class="butoes-all">

    <a href="<?=PROOT?>shopped" class="butoes-one">Pedidos</a>

</div>

