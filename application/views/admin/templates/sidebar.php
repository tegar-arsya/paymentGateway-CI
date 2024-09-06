<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard Cendana</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <!-- <link rel="icon" href="<?php echo base_url(); ?>assets/img/kaiadmin/favicon.ico" type="image/x-icon" /> -->
    <!-- Fonts and icons -->
    <script src="<?php echo base_url(); ?>assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["<?php echo base_url(); ?>assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="#" class="logo">
                        <h2 style="color: white;">CENDANA</h2>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <?php $segment = $this->uri->segment(2); ?>
                        <li class="nav-item <?= ($segment == '' || $segment == 'dashboard') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin') ?>" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($segment == 'kamar') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin/kamar') ?>" class="collapsed" aria-expanded="false">
                                <i class="bi bi-house"></i>
                                <p>Data Kamar</p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($segment == 'penghuni') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin/penghuni') ?>" class="collapsed" aria-expanded="false">
                                <i class="bi bi-people-fill"></i>
                                <p>Data Penghuni</p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($segment == 'transaksi') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin/transaksi') ?>" class="collapsed" aria-expanded="false">
                                <i class="bi bi-cash"></i>
                                <p>Data Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($segment == 'laporan') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin/laporan') ?>" class="collapsed" aria-expanded="false">
                                <i class="bi bi-receipt-cutoff"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($segment == 'keluhan') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin/keluhan') ?>" class="collapsed" aria-expanded="false">
                                <i class="bi bi-chat-square-text-fill"></i>
                                <p>Keluhan Penghuni</p>
                            </a>
                        </li>
                        <li class="nav-item <?= ($segment == 'akun') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin/akun') ?>" class="collapsed" aria-expanded="false">
                                <i class="fas fa-address-book"></i>
                                <p>Manajement Akun</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="<?php echo base_url(); ?>assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <!-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div> -->
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                                    <!-- <i class="fa fa-search"></i> -->
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <!-- <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form> -->
                                </ul>
                            </li>

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="<?= base_url('uploads/profile/' . $user['image']); ?>" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold"><?= $user['nama'] ?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="<?= base_url('uploads/profile/' . $user['image']); ?>" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?= $user['nama'] ?></h4>
                                                    <p class="text-muted"><?= $user['email'] ?></p>
                                                    <a href="<?= base_url('admin/profile') ?>" class="btn btn-xs btn-secondary btn-sm">Lihat Profil</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>