<?php
/**
 * @file    register.blade.php
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
                <h2 class="section-heading text-uppercase">Register</h2>
                <h3 class="section-subheading text-muted">Veuillez vous enregistrer pour accéder à vos données.</h3>
            </div>
            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-12">
                        <div class="form-group">
                        <!-- Gender input-->
                            <input id="male" type="radio" placeholder="Homme" name="gender" value="male" required />
                            <label class="form-label" style="color: white; margin-right: 20px" for="male">Homme</label>

                            <input id="female" type="radio" placeholder="Femme" name="gender" value="female" required />
                            <label class="form-label" style="color: white" for="female">Femme</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- Lastname input-->
                            <input class="form-control" id="lastname" type="text" placeholder="Votre nom *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="lastname:required">Un nom est nécessaire.</div>
                        </div>
                        <div class="form-group">
                            <!-- Firstname input-->
                            <input class="form-control" id="firstname" type="text" placeholder="Votre prénom *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="firstname:required">Un prénom est nécessaire.</div>
                        </div>
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" id="email" type="email" placeholder="Votre email *" data-sb-validations="required,email" />
                            <div class="invalid-feedback" data-sb-feedback="email:required">Un email est nécessaire.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email invalide.</div>
                        </div>
                        <div class="form-group">
                            <!-- Password input-->
                            <input class="form-control" id="password" type="password" placeholder="Votre mot de passe *" data-sb-validations="required,password" />
                            <div class="invalid-feedback" data-sb-feedback="password:required">Un mot de passe est nécessaire.</div>
                        </div>
                        <div class="form-group">
                            <!-- Password input-->
                            <input class="form-control" id="password" type="password" placeholder="Confirmer votre mot de passe *" data-sb-validations="required,password" />
                            <div class="invalid-feedback" data-sb-feedback="password:required">Un mot de passe est nécessaire.</div>
                            <div class="invalid-feedback" data-sb-feedback="password:password">Mot de passe invalide.</div>
                        </div>
                        <div class="form-group">
                            <!-- Birthdate input-->
                            <input class="form-control" id="birthdate" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Votre date de naissance *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="birthdate:required">Date de naissance nécessaire.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Height input-->
                            <input class="form-control" id="height" type="number" placeholder="Votre taille *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="height:required">Une taille est nécessaire.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Weight input-->
                            <input class="form-control" id="weight" type="number" placeholder="Votre poids *" data-sb-validations="required" />
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
                <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" id="submitButton" type="submit">S'enregistrer</button></div>
            </form>
        </div>
    </section>
@endsection
