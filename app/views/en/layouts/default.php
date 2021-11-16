<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=PROOT?><?=TPROOT?>assets/img/favicon.png" rel="icon">
  <link href="<?=PROOT?><?=TPROOT?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=PROOT?><?=TPROOT?>assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?=PROOT?><?=TPROOT?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?=PROOT?><?=TPROOT?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=PROOT?><?=TPROOT?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=PROOT?><?=TPROOT?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?=PROOT?><?=TPROOT?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=PROOT?><?=TPROOT?>assets/css/style.css" rel="stylesheet">


  <link rel="stylesheet"  href="<?=PROOT?>css/style1.css">
  <script src="<?=PROOT?>js/home.js"></script>
  <script src="<?=PROOT?>js/jquery-3.5.1.js"></script>



  <link rel="icon" href="<?=LOGO;?>">
  <title><?=$this->siteTitle();?></title>

  <?= $this->content('head'); ?>
  <style>
  </style>
</head>

<body>

<?php include 'main_manu.php'; ?>
<main id="main">
  <?= $this->content('body'); ?>


</main><!-- End #main -->

<script>

  document.getElementById('main')[0].style.minHeight = (innerHeight - 250) + "px";
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<?php include 'footer.php'; ?>

</body>

</html>











