<?php

$menu = Router::getMenu('menu_acl');
$currentPage = currentPage();
//dnd($currentPage);
//dnd($menu);

?>


<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-11 d-flex align-items-center justify-content-between">
                <h1 class="logo"><a href="<?=PROOT?>"><?=MENU_BRAND?></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
                <nav id="navbar" class="navbar">
                    <ul>
                        <?php foreach($menu as $key => $val):
                            $active = ''; ?>
                            <?php
                            if(is_array($val)): ?>
                                <li class="dropdown"><a href="#"><span><?=$key?></span> <i class="bi bi-chevron-down"></i></a>
                                    <ul>
                                        <?php foreach($val as $k => $v):
                                            ?>
                                            <li><a href="<?=$v?>"><?=$k?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php else:
                                $active = ($val == $currentPage) ? 'active' : '' ?>
                                <li><a class="nav-link scrollto" href="<?=$val?>"><?=$key?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
            </div>
        </div>
    </div>
</header><!-- End Header -->







































