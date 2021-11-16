<?php $this->start('head');?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>






<section class="section">
    <h1 class="section-title">
        Conselho Executivo 9972442 - Alexandre
    </h1>

    <?php

    foreach($this->staffs as $staff){
        ?>
        <form action="<?=PROOT?>home/staff/<?= $staff->post_id;?>" method="post" class="form" enctype="multipart/form-data">


            <div class="response">
                <?= $this->displayErrors;?>
            </div>

            <div class="row">
                <h1 class="section-title">
                    <?= $staff->post_name;?>
                </h1>
                <div class="col-3-of-4">
                    <div class="form__group">
                        <input type="text" class="form__input" id="titulo<?= $staff->post_id;?>" name="titulo"
                               placeholder="Nome"  />
                        <label for="titulo" class="form__label">Nome</label>

                    </div>



                </div>
                <div class="col-1-of-4"><div class="form__group">
                        <label for="foto">Fotografia</label>
                        <input type="file" id="photo<?= $staff->post_id;?>" name="photo">
                    </div>
                </div>
            </div>


            <input type="hidden" name="token" value="<?php echo $this->token; ?>">
            <input type="submit" class="btn btn--white" value="Publicar">



        </form>

        <?php
    }

    ?>
</section>






<?php $this->end(); ?>
