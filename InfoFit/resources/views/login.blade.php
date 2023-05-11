<?php
/**
 * @file    login.blade.php
 * @brief   File description
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
                <h3 class="section-subheading text-muted">Veuillez vous enregistrer pour accéder à vos données.</h3>
            </div>
            <form id="contactForm" data-sb-form-api-token="API_TOKEN" action="/login">
                @csrf
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" id="email" type="email" placeholder="Votre email *" data-sb-validations="required,email" />
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <!-- Password input-->
                            <input class="form-control" id="password" type="password" placeholder="Votre mot de passe *" data-sb-validations="required,password" />
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Submit success message-->
                <!---->
                <!-- This is what your users will see when the form-->
                <!-- has successfully submitted-->
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        To activate this form, sign up at
                        <br />
                        <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>
                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Connection impossible</div></div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" id="submitButton" type="submit">Se connecter</button></div>
            </form>
        </div>
    </section>
@endsection
