<?php
/**
 * @file    register.blade.php
 * @brief   This view displays the register form to create a new user account
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
                <h3 class="section-subheading text-white">Veuillez vous enregistrer pour accéder à vos données.</h3>
            </div>
            <form id="contactForm" method="post" action="{{'/users'}}">
                @if(Session::has('fail'))
                <div class="alert alert-success">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-12">
                        <div class="form-group">
                        <!-- Gender input-->
                            <input id="male" type="radio" placeholder="Homme" name="gender" value="Male"/>
                            <label class="form-label" style="color: white; margin-right: 20px" for="male">Homme</label>

                            <input id="female" type="radio" placeholder="Femme" name="gender" value="Female"/>
                            <label class="form-label" style="color: white" for="female">Femme</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- Lastname input-->
                            <input class="form-control" name="lastname" type="text" placeholder="Votre nom *" value="{{old('lastname')}}"/>
                            <span class="text-danger">@error('lastname') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <!-- Firstname input-->
                            <input class="form-control" name="firstname" type="text" placeholder="Votre prénom *" value="{{old('firstname')}}"/>
                            <span class="text-danger">@error('firstname') {{$message}} @enderror</span>
                        </div>
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
                        <div class="form-group">
                            <!-- Password input-->
                            <input class="form-control" name="password_confirmation" type="password" placeholder="Confirmer votre mot de passe *"/>
                            <span class="text-danger">@error('password_confirmation') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <!-- Birthdate input-->
                            <input class="form-control" name="birthdate" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Votre date de naissance *" value="{{old('birthdate')}}"/>
                            <span class="text-danger">@error('birthdate') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Height input-->
                            <input class="form-control" name="height" type="number" placeholder="Votre taille en cm *" value="{{old('height')}}"/>
                            <span class="text-danger">@error('height') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Weight input-->
                            <input class="form-control" name="weight" type="number" placeholder="Votre poids en kg *" value="{{old('weight')}}"/>
                            <span class="text-danger">@error('weight') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" name="submitButton" type="submit">S'enregistrer</button></div>
            </form>
        </div>
    </section>
@endsection
