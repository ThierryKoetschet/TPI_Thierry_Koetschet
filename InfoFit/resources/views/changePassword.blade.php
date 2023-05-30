<?php
/**
 * @file    changePassword.blade.php
 * @brief   This page displays the form to allow the user to change passwords in case he's forgotten it
 * @author  Created by Thierry.KOETSCHET
 * @version 30.05.2023
 */
?>
@extends('layout')

@section('content')

    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Changement de mot de passe</h2>
                <h3 class="section-subheading text-white">Veuillez saisir un nouveau mot de passe.</h3>
            </div>
            <form id="contactForm" method="post" action="{{'/changePassword'}}">
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
                            <input class="form-control" name="password" type="password" placeholder="Votre nouveau mot de passe *"/>
                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <!-- Password input-->
                            <input class="form-control" name="password_confirmation" type="password" placeholder="Confirmer votre mot de passe *"/>
                            <span class="text-danger">@error('password_confirmation') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" name="submitButton" type="submit">Sauvegarder</button></div>
            </form>
        </div>
    </section>
@endsection
