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
                <h2 class="section-heading text-uppercase text-white">IMC</h2><br>
                <p class="text-white text-uppercase">Votre indice de masse corporel est de </p>
                <a class="btn btn-danger btn-xl text-uppercase" disabled>{{end($data)[2]}}</a><br><br><br><br>
                <h2 class="section-heading text-uppercase text-white">Historique</h2>
            </div>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);


            function drawChart() {
                let data = google.visualization.arrayToDataTable(

                    <?php
                    echo json_encode($data); ?>
                );

                let options = {
                    title: 'Company Performance',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                };

                let chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                chart.draw(data, options);
            }
        </script>
        <div id="curve_chart" style="width: 900px; height: 500px; margin-right: auto; margin-left: auto"></div>
    </section>

@endsection
