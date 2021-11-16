<?php $this->start('head');?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v7.0&appId=2468585373389622&autoLogAppEvents=1" nonce="PvUoG18B"></script>



<meta property="og:url"           content="https://camaramezochi.st/home/turismoread/<?=$this->post->post_id;?>" />
<meta property="og:type"          content="www.camaramezochi.st" />
<meta property="og:title"         content="<?=$this->post->post_title;?>" />
<meta property="og:description"   content="Camara Distrital de Mé-Zochi" />
<meta property="og:image"         content="https://camaramezochi.st/files/turismos/<?=$this->post->file_name;?>" />




<?php $this->end(); ?>

<?php $this->start('body'); ?>



<section class="section-read row">

    <div class="read">
        <div class="read__content">

            <div class="read__content__title">
                <?=utf8_decode($this->post->post_title);?>
            </div>
            <div class="read__content__picture" style="background-image: url('<?=PROOT?>files/turismos/<?=$this->post->file_name;?>'">
            </div>
            <div class="read__content__text">


                <?=$this->post->post_text;?>




            </div>
        </div>
        <div class="fb-comments" data-href="http://camaramezochi.st/home/turismoread/<?=$this->post->post_id;?>" data-width="" data-numposts="5"></div>

    </div>
    <?php
    $countfirst = 0;
    foreach($this->lasts  as $last):
        $countfirst++;

        ?>


        <a href="<?=PROOT?>home/turismoread/<?=$last->post_id;?>"  class="recent-post__item" style="background-image: url('<?=PROOT?>files/turismos/<?=$last->file_name;?>')">
            <h1 class="recent-post__item__title">
                <?=$last->post_title;?>
            </h1>
        </a>
        <?php
    endforeach;
    ?>

</section>


<?php $this->end(); ?>
