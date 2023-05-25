<?php
/**
 * @file    alimentation.blade.php
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
                <h2 class="section-heading text-uppercase">Alimentation</h2>
                <h3 class="section-subheading text-white">Traquez votre alimentation quotidienne !</h3>
            </div>
            <form id="contactForm" method="post" action="{{'/showAdd'}}">
                @csrf
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6 ms-auto me-auto">
                        <div class="form-group">
                            <!-- Lastname input-->
                            <input class="form-control" id="date" name="date" type="date" value="{{$date}}" oninput='changeDate()'/>
                        </div>
                    </div>
                </div>
                <table class="text-white" width="100%">
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
                        <th style="padding-bottom: 25px; padding-top: 25px">Petit déjeuner</th>
                    </tr>
                    @foreach($foodstuffList as $foodstuff)
                        @if($foodstuff['period'] == 'breakfast')
                        <tr>
                            <td>{{$foodstuff['title']}} {{$foodstuff['quantity']}}g</td>
                            <td class="text-center">{{$foodstuff['calories']}}</td>
                            <td class="text-center">{{$foodstuff['carbohydrates']}}</td>
                            <td class="text-center">{{$foodstuff['lipids']}}</td>
                            <td class="text-center">{{$foodstuff['proteins']}}</td>
                            <td>
                                <a href="/deleteFoodstuff/{{$foodstuff['id']}}/{{$date}}"><i class="fa-solid fa-minus btn btn-danger"></i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td><button class="btn btn-danger mx-2" name="breakfast" type="submit">Ajouter un aliment</button></td>
                    </tr>
                    <tr>
                        <th style="padding-bottom: 25px; padding-top: 25px">Dîner</th>
                    </tr>
                    @foreach($foodstuffList as $foodstuff)
                        @if($foodstuff['period'] == 'diner')
                        <tr>
                            <td>{{$foodstuff['title']}} {{$foodstuff['quantity']}}g</td>
                            <td class="text-center">{{$foodstuff['calories']}}</td>
                            <td class="text-center">{{$foodstuff['carbohydrates']}}</td>
                            <td class="text-center">{{$foodstuff['lipids']}}</td>
                            <td class="text-center">{{$foodstuff['proteins']}}</td>
                            <td>
                                <a href="/deleteFoodstuff/{{$foodstuff['id']}}/{{$date}}"><i class="fa-solid fa-minus btn btn-danger"></i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td><button class="btn btn-danger mx-2" name="diner" type="submit">Ajouter un aliment</button></td>
                    </tr>
                    <tr>
                        <th style="padding-bottom: 25px; padding-top: 25px">Souper</th>
                    </tr>
                    @foreach($foodstuffList as $foodstuff)
                        @if($foodstuff['period'] == 'supper')
                        <tr>
                            <td>{{$foodstuff['title']}} {{$foodstuff['quantity']}}g</td>
                            <td class="text-center">{{$foodstuff['calories']}}</td>
                            <td class="text-center">{{$foodstuff['carbohydrates']}}</td>
                            <td class="text-center">{{$foodstuff['lipids']}}</td>
                            <td class="text-center">{{$foodstuff['proteins']}}</td>
                            <td>
                                <a href="/deleteFoodstuff/{{$foodstuff['id']}}/{{$date}}"><i class="fa-solid fa-minus btn btn-danger"></i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td><button class="btn btn-danger mx-2" name="supper" type="submit">Ajouter un aliment</button></td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <?php
                        $caloriesSum = 0;
                        $carbSum = 0;
                        $lipidsSum = 0;
                        $proteinsSum = 0;
                        foreach($foodstuffList as $foodstuff) {
                            $caloriesSum += $foodstuff['calories'];
                            $carbSum += $foodstuff['carbohydrates'];
                            $lipidsSum += $foodstuff['lipids'];
                            $proteinsSum += $foodstuff['proteins'];
                        }
                        ?>
                        <th style="padding-bottom: 25px; padding-top: 25px">Total</th>
                        <th class="text-center">{{$caloriesSum}}</th>
                        <th class="text-center">{{$carbSum}}</th>
                        <th class="text-center">{{$lipidsSum}}</th>
                        <th class="text-center">{{$proteinsSum}}</th>
                    </tr>
                </table>
            </form>
        </div>
    </section>
    <script>
        function changeDate() {
            location.href="/alimentation/"+document.getElementById('date').value
        }
    </script>
@endsection
