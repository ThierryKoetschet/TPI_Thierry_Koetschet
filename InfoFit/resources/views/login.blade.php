<?php
/**
 * @file    login.blade.php
 * @brief   This view displays the form to log the user in
 * @author  Created by Thierry.KOETSCHET
 * @version 08.05.2023
 */
?>
@extends('layout')

@section('content')

    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Login</h2>
                <h3 class="section-subheading text-white">Veuillez vous enregistrer pour accéder à vos données.</h3>
            </div>
            <form id="contactForm" method="post" action="{{'/authenticate'}}">
                @csrf
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" name="email" type="email" placeholder="Votre email *" value="{{old('email')}}"/>
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <!-- Password input-->
                            <input class="form-control" name="password" type="password" placeholder="Votre mot de passe *"/>
                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                        </div>
                        <a href="/newPassword">Mot de passe oublié ?</a>
                    </div>
                </div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" name="submitButton" type="submit">S'enregistrer</button></div>
            </form>
        </div>
    </section>
@endsection
