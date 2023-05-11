<?php
/**
 * @file    home.blade.php
 * @brief   File description
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
            <img src="assets/img/logo_infofit.png" style="width: 55%"><br><br><br><br>
            <div class="masthead-subheading">Veuillez vous connecter pour accéder à votre profil</div>
            <a class="btn btn-danger btn-xl text-uppercase" href="login">Se connecter</a><br><br><br>
            <div class="masthead-subheading">Vous ne possédez pas encore de compte? Profitez-en pour vous inscrire!</div>
            <a class="btn btn-danger btn-xl text-uppercase" href="register">S'enregistrer</a>
        </div>
    </header>

{{--
    <h1>{{$heading}}</h1>

@unless(count($listings) == 0)

@foreach($listings as $listing)
<h2>
    <a href="/home/{{$listing['id']}}">{{$listing['title']}}</a>
</h2>
<p>
    {{$listing['description']}}
</p>
@endforeach

@else
<p>No listing found</p>
@endunless
--}}
@endsection

