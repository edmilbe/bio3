



<!-- ======= Contact Section ======= -->
<section id="contact" class="section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h3>Contacte nos</h3>
            <p>Será um prazer estar em contacto consigo, por favor fique ligado à nós</p>
        </div>

        <div class="row contact-info">

            <div class="col-md-4">
                <div class="contact-address">
                    <i class="bi bi-geo-alt"></i>
                    <h3>Endereço</h3>
                    <address>Mesquita, São Tomé e Príncipe</address>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-phone">
                    <i class="bi bi-phone"></i>
                    <h3>Telefone</h3>
                    <p><a href="tel:+155895548855">+239 991 42 74</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-email">
                    <i class="bi bi-envelope"></i>
                    <h3>Email</h3>
                    <p><a href="mailto:info@example.com">info@example.com</a></p>
                </div>
            </div>

        </div>



    </div>
</section><!-- End Contact Section -->




<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-info">
                    <h3><?=MENU_BRAND?></h3>
                    <p>
                        Este site é da autoria do Movimento biológico no quadro do projecto OM4D....</p>

                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Links rápidos</h4>
                    <ul>


                        <?php foreach($menu as $key => $val):
                            $active = ''; ?>
                            <?php
                            if(is_array($val)): ?>

                            <?php else:
                                $active = ($val == $currentPage) ? 'active' : '' ?>
                                <li><i class="bi bi-chevron-right"></i> <a href="<?=$val?>"><?=$key?></a></li>

                            <?php endif; ?>
                        <?php endforeach; ?>


                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contacte nos</h4>
                    <p>
                        Mesquita <br>
                        Água Grande<br>
                        São Tomé e Príncipe <br>
                        <strong>Phone:</strong> +239 991 42 74<br>
                        <strong>Email:</strong> info@example.com<br>
                    </p>

                    <div class="social-links">
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    </div>

                </div>



            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            Todos os director reservados &COPY; <strong><?=MENU_BRAND?></strong>
        </div>
        <div class="credits">
            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
          -->
            Made by <a href="#"><strong>BonsMambos</strong></a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Uncomment below i you want to use a preloader -->
<!-- <div id="preloader"></div> -->

<!-- Vendor JS Files -->
<script src="<?=PROOT?><?=TPROOT?>assets/vendor/aos/aos.js"></script>
<script src="<?=PROOT?><?=TPROOT?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=PROOT?><?=TPROOT?>assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?=PROOT?><?=TPROOT?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?=PROOT?><?=TPROOT?>assets/vendor/php-email-form/validate.js"></script>
<script src="<?=PROOT?><?=TPROOT?>assets/vendor/purecounter/purecounter.js"></script>
<script src="<?=PROOT?><?=TPROOT?>assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?=PROOT?><?=TPROOT?>assets/vendor/waypoints/noframework.waypoints.js"></script>

<!-- Template Main JS File -->
<script src="<?=PROOT?><?=TPROOT?>assets/js/main.js"></script>
