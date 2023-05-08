<?php
/**
 * @file    home.blade.php
 * @brief   File description
 * @author  Created by Thierry.KOETSCHET
 * @version 08.05.2023
 */
?>
@extends('layout')

@section('content')

<h1>{{$heading}}</h1>

@unless(count($listings) == 0)

@foreach($listings as $listing)
<h2>
    <a href="/home/{{$listing['id']}}">{{$listing['title']}}</a>
</h2>
<p>
    {{$listing['description']}}
</p>
@endforeach

@else
<p>No listing found</p>
@endunless

@endsection
