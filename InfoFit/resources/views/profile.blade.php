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
                <h3 class="section-subheading text-white">Modifier votre poids pour visualiser votre évolution !</h3>
            </div>
            <form id="contactForm" method="post" action="{{'/updateWeight'}}">
                @csrf
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- Lastname input-->
                            <input class="form-control" name="lastname" type="text" value="{{auth()->user()->lastname}}" readonly/>
                        </div>
                        <div class="form-group">
                            <!-- Firstname input-->
                            <input class="form-control" name="firstname" type="text" value="{{auth()->user()->firstname}}" readonly/>
                        </div>
                        <div class="form-group">
                            <!-- Birthdate input-->
                            <input class="form-control" name="birthdate" type="date" value="{{auth()->user()->birthdate}}" readonly/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Height input-->
                            <label class="form-label text-white text-uppercase" id="height" style="padding-left: 50%; padding-top: 20px">Taille</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Height input-->
                            <input class="form-control" name="height" type="number" value="{{auth()->user()->height}}" readonly/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Height input-->
                            <label class="form-label text-white text-uppercase" id="weight" style="padding-left: 50%; padding-top: 20px">Poids</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Weight input-->
                            <input class="form-control" name="weight" type="number" value="{{$lastWeight->value}}"/>
                            <span class="text-danger">@error('weight') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" name="submitButton" type="submit">Modifier</button></div>
            </form>
            <form id="contactForm" method="get" action="{{'/deleteUser'}}">
                <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase mt-5" name="deleteButton" type="submit">Supprimer le compte</button></div>
            </form>
        </div>
    </section>
@endsection
