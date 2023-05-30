<?php
/**
 * @file    home.blade.php
 * @brief   This view displays the home page
 * @author  Created by Thierry.KOETSCHET
 * @version 08.05.2023
 */
?>
@extends('layout')

@section('content')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-heading text-uppercase">Bienvenue chez </div>
            <img src="assets/img/logo_infofit.png" style="width: 45%"><br><br><br><br>
            <div class="masthead-subheading">Veuillez vous connecter pour accéder à votre profil</div>
            <a class="btn btn-danger btn-xl text-uppercase" href="login">Se connecter</a><br><br><br>
            <div class="masthead-subheading">Vous ne possédez pas encore de compte? Profitez-en pour vous inscrire!</div>
            <a class="btn btn-danger btn-xl text-uppercase" href="register">S'enregistrer</a>
        </div>
    </header>
@endsection

