<?php $this->start('head'); ?>
<style>



    .img-back{
        width: 100%;
        height: auto !important;
        background-position: top;
        background-size: cover;
        background-repeat: no-repeat;
    }
    #carosenews{
        width: 100%;
        height: 400px;


    }

    #carosenews .carousel-item{
        height: 400px;
        background-position: top;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .img__bg{

        background-position: center;
        background-size: cover;

    }
    .img__bg__news{

        height: 20rem;

    }




    .card{
        height: 250px;

    }

    .card__img{
        height: 150px;
        position: relative;
        background-position: top;
        background-size: cover;
        background-repeat: no-repeat;
    }
    a{
        text-decoration: none;
        color: black;
    }
    .portfolio-info > h4, .portfolio-info > h4 > a{
         line-height: 1;
    }
</style>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<!-- ======= hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">



                <?php

                $cont = 0;

                foreach ($this->lasts as $last) {
                    if ($cont == 0) {
                        ?>


                        <div class="carousel-item active"
                             style="background-image: url('<?= PROOT ?>files/posts/<?= $last->file_name; ?>')">
                            <div class="carousel-container">
                                <div class="container">
                                    <h2 class="animate__animated animate__fadeInDown"><?= $last->post_title; ?></h2>

                                    <p class="animate__animated animate__fadeInUp">Texto</p>
                                    <a href="#featured-services"
                                       class="btn-get-started scrollto animate__animated animate__fadeInUp">Ler mais &rightarrow;</a>
                                </div>
                            </div>
                        </div>

                        <?php
                    }else {
                        ?>
                        <div class="carousel-item"
                             style="background-image: url('<?= PROOT ?>files/posts/<?= $last->file_name; ?>')">
                            <div class="carousel-container">
                                <div class="container">
                                    <h2 class="animate__animated animate__fadeInDown"><?= $last->post_title; ?></h2>

                                    <p class="animate__animated animate__fadeInUp">Texto.</p>
                                    <a href="#featured-services"
                                       class="btn-get-started scrollto animate__animated animate__fadeInUp">Ler mais &rightarrow;</a>
                                </div>
                            </div>
                        </div>


                        <?php

                    }
                    $cont++;
                }


                ?>










            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </div>
</section><!-- End Hero Section -->

<!-- ======= Featured Services Section Section ======= -->



<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="section-bg">
    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h3 class="section-title">Atualizações</h3>
        </header>

        <div class="row" data-aos="fade-up" data-aos-delay="100"">

    </div>

    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">


        <?php

        $cont = 0;

        foreach ($this->lasts as $last) {
            $checked = $cont == 0 ? "active" : "";
            ?>



            <div class="col-lg-4 col-md-6 portfolio-item">



                <div class="portfolio-wrap">
                    <figure>
                        <img src="<?= PROOT ?>files/posts/<?= $last->file_name; ?>" class="img-fluid" alt="">
                        <a href="<?= PROOT ?>files/posts/<?= $last->file_name; ?>" data-lightbox="portfolio" data-title="App 1" class="link-preview"><i class="bi bi-plus"></i></a>
                        <a href="#" class="link-details" title="More Details"><i class="bi bi-link"></i></a>
                    </figure>

                    <div class="portfolio-info">
                        <h4><a href="<?=PROOT?><?=TPROOT?>#"><?= $last->post_title; ?></a></h4>
                    </div>
                </div>
            </div>

            <?php
            $cont++;
        }


        ?>






    </div>


</section><!-- End Portfolio Section -->

<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="section-bg">
    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h3>Associações Biológicas</h3>
        </header>






        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                <?php

                $cont = 0;

                foreach ($this->turismos as $last) {
                    $checked = $cont == 0 ? "active" : "";

                    if ($cont < 31):
                        ?>


                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="<?= PROOT ?>files/turismos/<?= $last->file_name; ?>" class="testimonial-img" alt="">
                                <h3><?= $last->post_title; ?></h3>
                                <a href="<?= PROOT ?>home/turismoread/<?= $last->post_id; ?>" class="btn btn-primary">Ver </a>
                                <p>
                                    <img src="<?=PROOT?><?=TPROOT?>assets/img/quote-sign-left.png" class="quote-sign-left" alt="">
                                    <?= $last->post_text; ?>
                                    <img src="<?=PROOT?><?=TPROOT?>assets/img/quote-sign-right.png" class="quote-sign-right" alt="">
                                </p>
                            </div>
                        </div><!-- End testimonial item -->










                        <?php
                    endif;
                    $cont++;
                }


                ?>








            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- End Testimonials Section -->

<!-- ======= Our Clients Section ======= -->
<section id="clients">
    <div class="container" data-aos="zoom-in">

        <header class="section-header">
            <h3>Nossos Parceiros</h3>
        </header>

        <div class="clients-slider swiper">
            <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide"><img src="<?=PROOT?><?=TPROOT?>assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="<?=PROOT?><?=TPROOT?>assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="<?=PROOT?><?=TPROOT?>assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="<?=PROOT?><?=TPROOT?>assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="<?=PROOT?><?=TPROOT?>assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="<?=PROOT?><?=TPROOT?>assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="<?=PROOT?><?=TPROOT?>assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="<?=PROOT?><?=TPROOT?>assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- End Our Clients Section -->


<!-- ======= Team Section ======= -->
<section id="team">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h3>Membros da OM4D</h3>
            <p>OM4D é composto por x membros, sendo x tencico ...</p>
        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="member" data-aos="fade-up" data-aos-delay="100">
                    <img src="<?=PROOT?><?=TPROOT?>assets/img/team-1.jpg" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Walter White</h4>
                            <span>Chief Executive Officer</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="member" data-aos="fade-up" data-aos-delay="200">
                    <img src="<?=PROOT?><?=TPROOT?>assets/img/team-2.jpg" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Sarah Jhonson</h4>
                            <span>Product Manager</span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="member" data-aos="fade-up" data-aos-delay="300">
                    <img src="<?=PROOT?><?=TPROOT?>assets/img/team-3.jpg" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>William Anderson</h4>
                            <span>CTO</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="member" data-aos="fade-up" data-aos-delay="400">
                    <img src="<?=PROOT?><?=TPROOT?>assets/img/team-4.jpg" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Amanda Jepson</h4>
                            <span>Accountant</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Team Section -->











<?php $this->end(); ?>
