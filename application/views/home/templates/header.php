<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Kontrakan Cendana</title>
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css'); ?> " rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/css/templatemo-villa-agency.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('https://unpkg.com/swiper@7/swiper-bundle.min.css'); ?> " />

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <ul class="info">
                        <li><i class="fa fa-envelope"></i> Cendana@gmail.com</li>
                        <li><i class="fa fa-map"></i> Cikampek- Jawa Barat </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="social-links">
                        <li><a href="https://wa.me/085624147174"><i class="fab fa-whatsapp-square" style="font: size 15px;; "></i></a></li>
                        <li><a href="https://maps.app.goo.gl/BXttGdiTHCrwv9xF6?g_st=com.google.maps.preview.copy"><i class="fas fa-map-marker-alt"></i></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="<?php echo base_url('/home'); ?>" class="logo">
                            <h1>Cendana</h1>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="<?php echo base_url('/home'); ?>" class="<?php echo ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == '') ? 'active' : ''; ?>">Home</a></li>
                            <li><a href="<?php echo base_url('home/kamar'); ?>" class="<?php echo $this->uri->segment(2) == 'kamar' ? 'active' : ''; ?>">Kamar</a></li>
                            <!-- <li><a href="<?php echo base_url('home/tentang'); ?>" class="<?php echo $this->uri->segment(2) == 'tentang' ? 'active' : ''; ?>">Tentang</a></li> -->
                            <li><a href="<?php echo base_url('home/kontak'); ?>" class="<?php echo $this->uri->segment(2) == 'kontak' ? 'active' : ''; ?>">Kontak</a></li>
                            <li><a href="<?php echo base_url('auth'); ?>">Login</a></li>
                            <li><a href="<?php echo base_url('auth/register'); ?>">Daftar</a></li>
                            <li></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->