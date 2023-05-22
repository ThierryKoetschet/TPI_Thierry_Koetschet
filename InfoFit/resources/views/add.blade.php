<?php
/**
 * @file    add.blade.php
 * @brief   File description
 * @author  Created by Thierry.KOETSCHET
 * @version 22.05.2023
 */
?>

@extends('layout')

@section('content')
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Ajouter un aliment</h2>
            </div>
            <form id="contactForm" method="post" action="{{'/searchFoodstuff'}}">
                @csrf
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Weight input-->
                            <input class="form-control" name="foodstuff" type="text"/>
                            <span class="text-danger">@error('weight') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Height input-->
                            <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" name="submitButton" type="submit">Chercher</button></div>
                        </div>
                    </div>
                </div>
            </form>
            <form id="contactForm" method="post" action="{{'/searchFoodstuff'}}">
                @csrf
                @if($productSelection)
                    <table class="text-white text-uppercase" width="100%">
                        <tr>
                            <th>Nom</th>
                            <th>Calories</th>
                            <th>Glucides</th>
                            <th>Lipides</th>
                            <th>Protéines</th>
                        </tr>

                    @foreach($productSelection as $product)
                        <?php dd($productSelection); ?>
                        <tr>
                            <td>{{$product['product_name']}}</td>
                            <td>{{$product['nutriments']['energy-kcal_100g']}}</td>
                            <td>{{$product['nutriments']['carbohydrates_100g']}}</td>
                            <td>{{$product['nutriments']['fat_100g']}}</td>
                            <td>{{$product['nutriments']['proteins_100g']}}</td>
                        </tr>
                    @endforeach
                    </table>
                @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Height input-->
                            <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" name="submitButton" type="submit">Chercher</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

