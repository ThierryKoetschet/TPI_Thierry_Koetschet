<?php
/**
 * @file    profile.blade.php
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
                <h2 class="section-heading text-uppercase">Profil</h2>
                <h3 class="section-subheading text-muted">Modifier votre poids pour observer votre évolution!</h3>
            </div>
            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- Lastname input-->
                            <input class="form-control" id="lastname" type="text" value="{{$user['lastname']}}" readonly />
                        </div>
                        <div class="form-group">
                            <!-- Firstname input-->
                            <input class="form-control" id="firstname" type="text" value="{{$user['firstname']}}" readonly />
                        </div>
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" id="email" type="email" value="{{$user['email']}}" readonly />
                        </div>
                        <div class="form-group">
                            <!-- Birthdate input-->
                            <input class="form-control" id="birthdate" type="text" placeholder="{{$user['birthdate']}}" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Height input-->
                            <input class="form-control" id="height" type="number" placeholder="{{$user['height']}}" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Weight input-->
                            <input class="form-control" id="weight" type="number" placeholder="{{$user['weight']}}" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="weight:required">Un poids est nécessaire.</div>
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
                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" id="submitButton" type="submit">Modifier</button></div>
            </form>
        </div>
    </section>
@endsection
