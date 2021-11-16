<?php $this->start('head');?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v7.0&appId=2468585373389622&autoLogAppEvents=1" nonce="PvUoG18B"></script>



<meta property="og:url"           content="http://camaramezochi.st/home/postread/<?=$this->post->post_id;?>" />
<meta property="og:type"          content="Site Informativo" />
<meta property="og:title"         content="<?=$this->post->post_title;?>" />
<meta property="og:description"   content="Camara Distrital de Mé-Zochi" />
<meta property="og:image"         content="http://camaramezochi.st/files/posts/<?=$this->post->file_name;?>" />




<?php $this->end(); ?>

<?php $this->start('body'); ?>



<section class="section-read">
    <div class="read">
        <div class="read__content">


            <div class="read__content__picture" style="background-image: url('<?=PROOT?>files/posts/<?=$this->post->file_name;?>'">
            </div>
            <div class="read__content__title">
                <?=$this->post->post_title;?>
            </div>
            <div class="read__content__text">


                <?=$this->post->post_text;?>




            </div>

            <div class="fb-comments" data-href="http://camaramezochi.st/home/postread/<?=$this->post->post_id;?>" data-width="" data-numposts="5"></div>


        </div>
        <div class="read__others">
            <?php
            $countfirst = 0;
            foreach($this->lasts  as $last):
                $countfirst++;

                ?>
                <a href="<?=PROOT?>home/postread/<?=$last->post_id;?>"  class="recent-post__item" style="background-image: url('<?=PROOT?>files/posts/<?=$last->file_name;?>')">
                    <h1 class="recent-post__item__title">
                        <?=$last->post_title;?>
                    </h1>
                </a>
                <?php
            endforeach;
            ?>
        </div>
    </div>
    <div class="col-3-of-4">

    </div>
    <div class="col-1-of-4">



    </div>
</section>


<?php $this->end(); ?>
