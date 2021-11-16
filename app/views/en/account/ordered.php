

<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<?php
//dnd($this->prds);

if($this->prds != false){
    ?>


    <div class="container">
        <?php
        foreach($this->prds as $prd){
            ?>

            <div class="row border-bottom">
                <div class="col">Compra &numero; <?=$prd->shopped_k_id < 10 ? "0". $prd->shopped_k_id : $prd->shopped_k_id ; ?></div>
                <div class="col"><?=$prd->total; ?> Items</div>
                <div class="col">
                    <a href="<?=PROOT?>account/statusordered/<?=$prd->shopped_k_id; ?>" class="text-primary">Vizualizar</a>
                </div>
                <div class="col">
                    <a target="_blank" href="../files/facturas/<?=$prd->shopped_k_fac;?>" class="text-primary">Fatura</a>

                </div>
            </div>

            <?php
        }
        ?>

    </div>

    <?php
}
?>


<?php $this->end(); ?>



