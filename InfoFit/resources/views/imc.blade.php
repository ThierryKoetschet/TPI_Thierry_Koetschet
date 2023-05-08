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

<h2>
    <a href="/home/{{$listing['id']}}">{{$listing['title']}}</a>
</h2>
<p>
    {{$listing['description']}}
</p>

@endsection
