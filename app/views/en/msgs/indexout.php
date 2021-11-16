
<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>




<div class="all" id="main-top">

    <div class="game">

        <section class="section">



            <?php
            //dnd($this->prds);

            if($this->msgs != false){
                ?>

                    <?php
                    foreach($this->msgs as $prd){
                        ?>
                        <div class="view-product box-section">

                            <div class="v-prd-det">
                                <h1 class="prd-name"><?=$prd->msg_o_name; ?></h1>
                                <p class="prd-desc"><?=$prd->msg_o_text; ?></p>
                                <p class="prd-marca">Email: <?=$prd->msg_o_email; ?></p>
                                <a class="botao botao-inline submit" href="<?=PROOT?>msgs/viewout/<?=$prd->msg_o_id?>">Replied</a>

                            </div>

                        </div>
                        <?php
                    }
                    ?>


                <?php
            }
            ?>
        </section>

    </div>
</div>

<?php $this->end(); ?>



