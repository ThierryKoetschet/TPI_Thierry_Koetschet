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
                <h3 class="section-subheading text-white">Saisissez le nom de l'aliment consommé !</h3>
            </div>
            <form id="contactForm" method="post" action="{{'/searchFoodstuff'}}">
                @csrf
                <div class="row align-items-stretch mb-5 mt-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Weight input-->
                            <input class="form-control" name="foodstuff" type="text"/>
                            <span class="text-danger">@error('weight') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="date" value="{{$infos['date']}}" readonly hidden>
                        <input name="period" type="text" value="{{$infos['period']}}" readonly hidden/>
                        <div class="form-group">
                            <!-- Height input-->
                            <div class="text-center"><button class="btn btn-danger btn-xl text-uppercase" name="submitButton" type="submit">Chercher</button></div>
                        </div>
                    </div>
                </div>
            </form>
                @if($productSelection)
                    <table class="text-white text-uppercase" width="100%">
                        <tr>
                            <th width="40%">Nom</th>
                            <th>Calories</th>
                            <th>Glucides</th>
                            <th>Lipides</th>
                            <th>Protéines</th>
                            <th>Quantité</th>
                        </tr>

                    @foreach($productSelection as $product)
                        <tr>
                            <td>{{$product['title']}}</td>
                            <td>{{$product['kcal_100g']}}</td>
                            <td>{{$product['carbohydrates_100g']}}</td>
                            <td>{{$product['lipids_100g']}}</td>
                            <td>{{$product['proteins_100g']}}</td>
                            <form method="post" action="{{'/addFoodstuff'}}">
                                @csrf
                                <td>
                                    <input class="form-control w-50" name="quantity" type="number" step="0.01" value="1" />
                                    <span class="text-danger">@error('quantity') {{$message}} @enderror</span>
                                </td>
                                <td>
                                    <input type="text" name="code" value="{{$product['code']}}" readonly hidden>
                                    <input type="text" name="title" value="{{$product['title']}}" readonly hidden>
                                    <input type="number" name="kcal_100g" value="{{$product['kcal_100g']}}" readonly hidden>
                                    <input type="number" name="carbohydrates_100g" value="{{$product['carbohydrates_100g']}}" readonly hidden>
                                    <input type="number" name="lipids_100g" value="{{$product['lipids_100g']}}" readonly hidden>
                                    <input type="number" name="proteins_100g" value="{{$product['proteins_100g']}}" readonly hidden>
                                    <input type="date" name="date" value="{{$infos['date']}}" readonly hidden>
                                    <input name="period" type="text" value="{{$infos['period']}}" readonly hidden/>
                                    <button class="btn btn-danger btn-social mx-2" name="addFoodstuff" type="submit"><i class="fa-solid fa-plus"></i></button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                    </table>
                @endif
        </div>
    </section>
@endsection

