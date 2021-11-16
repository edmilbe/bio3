<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="section" id="form-section">
    <h1 class="section-title">
        Áreas Turísticas
    </h1>


    <?php

    $countfirst = 0;


    foreach ($this->lasts as $last) {

        $countfirst++;
        ?>

        <div class="activite">
            <div class="activite__item">
                <a href="<?= PROOT ?>home/turismoread/<?= $last->post_id; ?>"
                   class="activite__item__link u_link_default">
                    <div style="background-image: url('<?= PROOT ?>files/turismos/<?= $last->file_name; ?>');"
                         class="card-img-top activite__item__img"
                        >
                    </div>
                    <div class="activite__item__body">
                        <h2 class="activite__item__title">
                            <?= utf8_decode($last->post_title); ?></h2>

                        <p class="activite__item__text">
                            <?php // $last->post_text; ?>
                        </p>
                    </div>
                </a>
            </div>
        </div>



        <?php


    }







    ?>

    <ul class="pagination">
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>home/turismos/">Ínicio</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>home/turismos/<?=($this->pageno <= 1) ? "": $this->pageno-1?>">&leftarrow; Anterior</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>home/turismos/<?=($this->pageno >= $this->total_pages) ? "": $this->pageno + 1?>">Seguinte &rightarrow;</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>home/turismos/<?=$this->total_pages?>">Final</a>
        </li>
    </ul>



</section>





<?php $this->end(); ?>
