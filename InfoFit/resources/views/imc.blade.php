<?php
/**
 * @file    imc.blade.php
 * @brief   File description
 * @author  Created by Thierry.KOETSCHET
 * @version 08.05.2023
 */
?>
@extends('layout')

@section('content')

    <section class="page-section" id="imc">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase text-white">IMC</h2>
                <h3 class="section-subheading text-muted">Veuillez vous enregistrer pour accéder à vos données.</h3>
            </div>
            <canvas id="weight-chart" style="width:100%;max-width:600px"></canvas>
        </div>
        <script>
            const xValues = [50,60,70,80,90,100,110,120,130,140,150];
            const yValues = [7,8,8,9,9,9,10,11,14,14,15];

            new Chart("weight-chart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                    }]
                },
                options: {
                    legend: {display: false},
                    scales: {
                        yAxes: [{ticks: {min: 6, max:16}}],
                    }
                }
            });
        </script>
    </section>

@endsection
