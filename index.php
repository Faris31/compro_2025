<?php
include 'admin/koneksi.php';

//settings
$querySetting = mysqli_query($koneksi, "SELECT * FROM settings LIMIT 1");
$rowSetting = mysqli_fetch_assoc($querySetting);

$querySlider = mysqli_query($koneksi, "SELECT * FROM sliders ORDER BY id DESC");
$rowSlider = mysqli_fetch_all($querySlider, MYSQLI_ASSOC);

$queryAbout = mysqli_query($koneksi, "SELECT * FROM about WHERE is_active = 1 ORDER BY id DESC");
$rowsAbout = mysqli_fetch_assoc($queryAbout);

$queryServices = mysqli_query($koneksi, "SELECT * FROM services WHERE is_active = 1 ORDER BY id DESC");
$rowsServices = mysqli_fetch_all($queryServices, MYSQLI_ASSOC);

// assoc > memunculkan data cuma satu
// all > memunculkan data lebih dari satu
// setiap ingin mengambil data dari database, jangan lupa di  buat dulu variable baru nya untuk koneksi ke database dan select dari table mana
// kemudian buat variable baru untuk menampilkan data dari databasenya

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>HighTech - IT Solutions Website Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="asset/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="asset/css/style.css" rel="stylesheet">


  <!-- dari sini kebawah css untuk blogs detail -->
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>



</head>

<body>

  <!-- Header Start -->
  <?php include 'inc/header.php' ?>
  <!-- Header End -->

  <?php

  if (isset($_GET['page'])) {
    if (file_exists('content/' . $_GET['page'] . '.php')) {
      include 'content/' . $_GET['page'] . '.php';
    } else {
      // include 'content/notfound.php';
    }
  } else {
    include 'content/home.php';
  }

  ?>

  <!-- Footer Start -->
  <?php include 'inc/footer.php'; ?>
  <!-- Footer End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="asset/lib/wow/wow.min.js"></script>
  <script src="asset/lib/easing/easing.min.js"></script>
  <script src="asset/lib/waypoints/waypoints.min.js"></script>
  <script src="asset/lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Template Javascript -->
  <script src="asset/js/main.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>