<?php
/**
 * @file    layout.blade.php
 * @brief   File description
 * @author  Created by Thierry.KOETSCHET
 * @version 08.05.2023
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>InfoFit</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="logo_small_infofit.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body id="page-top" style="background-color: #212529">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="home"><img src="assets/img/logo_small_infofit.png" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                @auth
                <li class="nav-item"><a class="nav-link" href="profile">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="imc">IMC</a></li>
                <li class="nav-item"><a class="nav-link" href="alimentation">Alimentation</a></li>
                <li class="nav-item"><a class="nav-link" href="logout">Logout</a></li>
                <strong><li class="nav-item"><a class="nav-link" href="#">{{auth()->user()->firstname}} {{auth()->user()->lastname}}</a></li></strong>
                @else
                <li class="nav-item"><a class="nav-link" href="home">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="login">Se connecter</a></li>
                <li class="nav-item"><a class="nav-link" href="register">S'enregistrer</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- View output--}}
@yield('content')

<!-- Footer-->
<footer class="footer py-4" style="background-color: #1b7ca6">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">Projet de TPI 2023</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-end">Thierry Koetschet | Chemin du Perrey 22 | thierry.koetschet.1998@gmail.com</div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
