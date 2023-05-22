<?php
/**
 * @file    alimentation.blade.php
 * @brief   File description
 * @author  Created by Thierry.KOETSCHET
 * @version 08.05.2023
 */
$today = date("Y-m-d");
?>
@extends('layout')

@section('content')
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Alimentation</h2>
                <h3 class="section-subheading text-white">Traquez votre alimentation quotidienne !</h3>
            </div>
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6 ms-auto me-auto">
                    <div class="form-group">
                        <!-- Lastname input-->
                        <input class="form-control" name="date" type="date" value="{{$today}}"/>
                    </div>
                </div>
            </div>
            <table class="text-white text-uppercase" width="100%">
                <tr>
                    <th></th>
                    <th style="text-align: center">Calories</th>
                    <th style="text-align: center">Glucides</th>
                    <th style="text-align: center">Lipides</th>
                    <th style="text-align: center">Protéines</th>
                </tr>
                <tr>
                    <th></th>
                    <th style="text-align: center">[kcal]</th>
                    <th style="text-align: center">[g]</th>
                    <th style="text-align: center">[g]</th>
                    <th style="text-align: center">[g]</th>
                </tr>
                <tr>
                    <th>Petit déjeuner</th>
                </tr>
                <tr>
                    <td><a href="/add">Ajouter un aliment</a></td>
                </tr>
                <tr>
                    <th>Dîner</th>
                </tr>
                <tr>
                    <td><a href="/add">Ajouter un aliment</a></td>
                </tr>
                <tr>
                    <th>Souper</th>
                </tr>
                <tr>
                    <td><a href="/add">Ajouter un aliment</a></td>
                </tr>
                <tr>
                    <th>Total</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </section>
@endsection
