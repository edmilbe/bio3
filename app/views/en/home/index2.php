<?php $this->start('body'); ?>

<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="all" id="main-top">
    <div class="btn-abs btn-solto-go-top">
        <a href="#main-top"> <i class="fas fa-angle-double-up"></i>
        </a>
    </div>
    <div class="game">
        <aside class="game-aside">
            <!--
            <aside class="aside right">
                <span class="opcao filtro">&#9660;Filtros</span>
                <ul class="aside-list">
                    <li><a href="#">item</a></li>
                    <li><a href="#">item</a></li>
                    <li><a href="#">item</a></li>
                    <li><a href="#">item</a></li>
                    <li><a href="#">item</a></li>
                </ul>
            </aside>
            -->
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
                        <li><a href="<?= PROOT ?>home/index/<?= $prd->group1_id; ?>"
                               class="<?php
                               echo $this->selected == $prd->group1_id ? "selected" : "";

                               ?>"

                                ><?= $prd->group1_name; ?></a></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </aside>
        </aside>
        <section class="section">
            <div class="letters">
                <div class="letter-gr">
                    <a class="letter">A</a>
                    <a class="letter">B</a>
                    <a class="letter">C</a>
                    <a class="letter">D</a>
                    <a class="letter">E</a>

                </div>
                <div class="letter-gr">
                    <a class="letter">F</a>
                    <a class="letter">G</a>
                    <a class="letter">H</a>
                    <a class="letter">I</a>
                    <a class="letter">J</a>
                </div>
                <div class="letter-gr">
                    <a class="letter">K</a>
                    <a class="letter">L</a>
                    <a class="letter">M</a>
                    <a class="letter">N</a>
                    <a class="letter">O</a>
                </div>
                <div class="letter-gr">
                    <a class="letter">P</a>
                    <a class="letter">Q</a>
                    <a class="letter">R</a>
                    <a class="letter">S</a>
                    <a class="letter">T</a>
                </div>
                <div class="letter-gr">
                    <a class="letter">U</a>
                    <a class="letter">V</a>
                    <a class="letter">X</a>
                    <a class="letter">W</a>
                    <a class="letter">Y</a>
                    <a class="letter">Z</a>
                </div>
            </div>
            <div class="letters">
                <div class="letter-gr">
                    <a class="letter" href="<?=PROOT?>home/index">&raquo; Home</a>

                    <?php
                    foreach ($this->nav as $key => $nav):
                        ?>
                        <a class="letter" href="<?=PROOT?>home/index/<?=$nav['group1_id'];?>">&raquo; <?=$nav['group1_name'];?></a>

                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
            if ($this->items != false):
                ?>
                <div class="items-all">
                    <?php


                    foreach ($this->items as $prd):

                        ?>
                        <div class="item-one">

                            <div class="item-img"><a href="<?= PROOT ?>home/index/<?=$this->selected;?>/<?= $prd->group2_id; ?>">
                                    <img src="<?=PROOT?>files/grupo2/<?=$prd->file_name;?>" alt="<?=$prd->group2_name;?>">
                                </a>
                            </div>
                            <span class="div100px"></span>

                            <div class="item-name">
                            <span><a
                                    href="<?= PROOT ?>home/index/<?=$this->selected;?>/<?= $prd->group2_id; ?>"><?= utf8_decode($prd->group2_name); ?></a></span>
                            </div>


                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
                <?php
            endif;

            ?>

        </section>

    </div>
</div>


<?php $this->end(); ?>
