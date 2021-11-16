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











<header class="header">
    <div class="navigation">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class="container-fluid">
                <img src="<?=PROOT?>files/fix/biologo.png" alt="Logo" width="30" class="d-inline-block align-text-top">

                <a class="navbar-brand" href="<?=PROOT?>"><?=MENU_BRAND?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <?php foreach($menu as $key => $val):
                            $active = ''; ?>
                            <?php
                            if(is_array($val)): ?>


                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?=$key?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <?php foreach($val as $k => $v):
                                            ?>
                                            <li><a class="dropdown-item" href="<?=$v?>"><?=$k?></a></li>

                                        <?php endforeach; ?>
                                    </ul>
                                </li>


                            <?php else:
                                $active = ($val == $currentPage) ? 'active' : '' ?>


                                <li class="nav-item">
                                    <a class="nav-link <?=$active;?>" aria-current="page" href="<?=$val?>"><?=$key?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </ul>

                </div>
            </div>
        </nav>





    </div>





</header>




























