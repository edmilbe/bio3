<?php $this->start('head');?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>




<section class="section-agenda">
    <h1 class="section-title">
        Agenda
    </h1>


    <div class="atestado">


        <?php
        foreach($this->results as $result):

            ?>
            <a href="<?= PROOT ?>home/done/<?= $result->atestado_id; ?>" class="atestado__item"> <?=$result->atestado_id;?> <?=$result->atestado_name;?></a>


            <?php
        endforeach;

        ?>


    </div>
</section>





<?php $this->end(); ?>
