<?php




?>

<?php $this->start('head'); ?>
<meta id="bbb" http-equiv="refresh" content="0;url=<?=$this->recive;?>/xxx">
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<section class="cont-terceiro detalhe-shopper">
    <?php ?>
    <div class="itens-shopped">

        <div class="item-shopped">
            <form class="shopped-pr">
                <div class="gp">
                    <label>Total</label>
                    <span class="item-name" id="shopping-tg"><?=$this->total?> DBS</span>
                </div>

            </form>
        </div>
        <div class="butoes-box">
            <a href="<?=PROOT?>home/gr1" class="butoes-one">Nova Compra</a>
            <a target="_blank" href="<?=PROOT?>files/facturas/<?=$this->recive;?>.pdf" class="butoes-one">Ver Factura</a>
        </div>

        </div>



</section>
<?php $this->end(); ?>



