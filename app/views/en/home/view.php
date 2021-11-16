<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>
<meta property="fb:app_id"                content="1769334863366932" />

<meta property="og:url"                content="https://2x-shopping.com/home/viewfull/<?=$this->item->prd_id?>" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="<?=$this->item->prd_name?>" />
<meta property="og:description"        content="<?php
if($this->item->prd_opc == 1){
    echo $this->item->pr_uni_preco;
}elseif($this->item->prd_opc == 2){
    echo $this->item->pr_solto_preco;
}elseif($this->item->prd_opc == 3){
    echo $this->item->pr_o_1_preco;
}
?>
                                        <?=MOEDA?>" />
<meta property="og:image"              content="https://2x-shopping.com/files/prds/<?=$this->item->file_name?>" />
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="all" id="main-top">

    <div class="game">
        <aside class="game-aside">

            <aside class="aside left">
                <div class="opcao">
                    <span class="items">&#9660;Products</span>

                    <form action="#">
                        <input type="text" class="aside-input">
                    </form>
                </div>
                <ul class="aside-list">
                    <?php
                    foreach ($this->others as $prd):
                        ?>
                        <li><a href="<?= PROOT ?>home/view/<?=  $this->on; ?>/<?=  $this->onon; ?>/<?= $prd->prd_id; ?>"
                               class="<?php
                               echo $this->selected == $prd->prd_id ? "selected" : "";

                               ?>"

                                ><?= utf8_decode($prd->prd_name); ?></a></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </aside>
        </aside>
        <section class="section">
            <div class="letters">
                <div class="letter-gr">
                    <?php
                    foreach ($this->nav as $key => $nav):
                        ?>
                        <a class="letter" href="<?=PROOT?>home/index/<?=$nav['group1_id'];?>">&raquo; <?=$nav['group1_name'];?></a>

                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <div class="view-product box-section">
                <div class="v-prd-img">
                    <img src="<?= PROOT ?>files/prds/<?=$this->item->file_name?>" alt="<?=$this->item->prd_name?>">
                </div>
                <div class="v-prd-det">
                    <h1 class="prd-name"><?=$this->item->prd_name?></h1>
                    <p class="prd-desc"><?=$this->item->prd_desc?></p>
                    <p class="prd-marca">Mark: <?=$this->item->marca_name;?></p>
                    <p class="prd-price">
                        Price: <?=MOEDA?>
                        <?php
                        if($this->item->prd_opc == 1){
                            echo $this->item->pr_uni_preco;
                        }elseif($this->item->prd_opc == 2){
                            echo $this->item->pr_solto_preco;
                        }elseif($this->item->prd_opc == 3){
                            echo $this->item->pr_o_1_preco;
                        }
                        ?>

                    </p>
                    <button class="botao" onclick="addfromindex(<?=$this->item->prd_id?>);">Add to cart</button>
                </div>
                <div class="v-prd-det">

                </div>
            </div>

        </section>

    </div>
</div>


<?php $this->end(); ?>
