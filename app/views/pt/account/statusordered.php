

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

                    <form class="shopping-pr">
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
                            <span class="s-titlo">Preco:</span>
                                        <span class="s-item-name"><?php
                                            echo $item->shopped_p_prc * $item->shopped_p_qt; ?> DBS</span>
                        </div>

                        <div class="gps">
                            <label class="s-titlo">Chegada:</label>

                            <span class="s-item-name"><?php echo $item->shopped_p_chegada == "1999-12-31 21:00:00" ? "Pendent" : $item->shopped_p_chegada;?></span>

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

<div class="butoes-all">

    <a href="<?=PROOT?>account/ordered" class="butoes-one">Compras</a>

</div>

