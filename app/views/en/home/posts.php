<?php $this->start('head'); ?>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v7.0&appId=2468585373389622&autoLogAppEvents=1" nonce="PvUoG18B"></script>



<meta property="og:url"           content="https://camaramezochi.st/home/postread/<?=$this->post->post_id;?>" />
<meta property="og:type"          content="www.camaramezochi.st" />
<meta property="og:title"         content="<?=$this->post->post_title;?>" />
<meta property="og:description"   content="Camara Distrital de Mé-Zochi" />
<meta property="og:image"         content="https://camaramezochi.st/files/posts/<?=$this->post->file_name;?>" />



<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="section" id="form-section">
    <h1 class="section-title">
        Actividades
    </h1>


    <?php

    $countfirst = 0;


    foreach ($this->lasts as $last) {

        $countfirst++;
            ?>

        <div class="activite">
            <div class="activite__item">
                <a href="<?= PROOT ?>home/postread/<?= $last->post_id; ?>"
                   class="activite__item__link u_link_default">
                    <div style="background-image: url('<?= PROOT ?>files/posts/<?= $last->file_name; ?>');"
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
            <a class="pagination__a" href="<?=PROOT?>home/posts/">Ínicio</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>home/posts/<?=($this->pageno <= 1) ? "": $this->pageno-1?>">&leftarrow; Anterior</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>home/posts/<?=($this->pageno >= $this->total_pages) ? "": $this->pageno + 1?>">Seguinte &rightarrow;</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>home/posts/<?=$this->total_pages?>">Final</a>
        </li>
    </ul>


</section>





<?php $this->end(); ?>
