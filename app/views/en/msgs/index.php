
<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="all" id="main-top">

    <div class="game">

        <section class="section box-section">


            <?php
            //dnd($this->prds);

            if($this->msgs != false){
                ?>
                <div class="itens-shopped ">
                    <?php
                    foreach($this->msgs as $prd){
                        ?>
                        <div class="item-shopped ">


                            <!--
                            <div class="item-fotodiv">
                                <img src="pic/ananas.jpg" alt="" class="item-foto">
                            </div>
                            -->
                            <form class="shopped-pr">
                                <div class="gp">
                                    <label>Status</label>

                                    <span class="item-name">Pendent</span>
                                </div>
                                <div class="gp">
                                    <label>Name</label>

                                    <span class="item-name"><?=$prd->user_fname; ?></span>
                                </div>
                                <div class="gp">
                                    <label>Message</label>

                                    <span class="item-name"><?=$prd->msg_i_text; ?></span>
                                </div>

                                <a href="<?=PROOT?>msgs/view/<?=$prd->msg_i_user; ?>" class="botao botao-inline">View</a>
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

    </div>
</div>


<?php $this->end(); ?>



