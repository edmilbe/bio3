<?php

    $menu = Router::getMenu('menu_acl');
$currentPage = currentPage();
//dnd($currentPage);
//dnd($menu);


?>


<div class="cont-cabeca">
    <div class="cabeca-center">
        <div class="center-content">
            <div class="img-logo">
                <a href="<?=PROOT?>home/index"><img src="<?=PROOT?>files/2x_feito/2x_shop_em_baixo2.jpg"></a>
            </div>
            <div class="emps">
                <div><span class="emps1">2X-Shopping</span></div>
                <div><span class="emps2"></span></div>
            </div>
            <div class="top-outros">
                <button id="menu-button" onclick="abremenu();" class="menu-button">Menu</button>

                <nav class="menu-main" id="nav-menu">
                    <button id="menu-close" onclick="fechamenu();" class="menu-button menu-close">&times;</button>

                    <ul class="menu-full" id="menu-full">


                        <?php foreach($menu as $key => $val):

                            $active = ''; ?>
                            <?php
                            if(is_array($val)): ?>
                                <li class="menu-item"><a href="#"><?=$key?></a>
                                    <ul class="menu-subitens">
                                        <?php foreach($val as $k => $v):
                                            $active = ($v == $currentPage) ? 'active' : '' ?>
                                            <li class="menu-subitem"><a href="<?=$v?>" class="item-menu"><?=$k?></a></li>
                                        <?php endforeach; ?>

                                    </ul>
                                </li>
                            <?php else:
                                ?>
                                <li class="menu-item"><a href="<?=$val?>"><?=$key?></a></li>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    </ul>
                </nav>

            </div>
            <a href="<?=PROOT?>home/box" class="link-cart"><img class="cart" src="<?=PROOT?>files/fix/cart.png"><span id="box-qt"></span></a>

        </div>

        <!--
        -->
    </div>

</div>