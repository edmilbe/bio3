<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<section class="cont-terceiro shopped-all">

    <?php
    //dnd($this->prds);
    if($this->prds != false){
        ?>
        <div class="itens-shopped">
            <?php
            foreach($this->prds as $prd){
                ?>
                <div class="item-shopped">


                    <!--
                    <div class="item-fotodiv">
                        <img src="pic/ananas.jpg" alt="" class="item-foto">
                    </div>
                    -->
                    <form class="shopped-pr">
                        <div class="gp">
                            <label>Estado</label>

                            <span class="item-name">Pendente</span>
                        </div>
                        <div class="gp">
                            <label>Compra</label>

                            <span class="item-name"><?=$prd->shopped_k_id; ?></span>
                        </div>
                        <div class="gp">
                            <label>Qtd. do Item</label>
                            <span class="item-name"><?=$prd->total; ?></span>
                        </div>
                        <a href="<?=PROOT?>account/statusordered/<?=$prd->shopped_k_id; ?>" class="butoes-one">Ver</a>
                        <a target="_blank" href="../files/facturas/<?=$prd->shopped_k_fac;?>" class="butoes-one">Factura</a>
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
