@extends('layouts.master') 

@section('titolo')
Canile
@endsection

@section('stile','style.css') 



@section('corpo')



<div class="cover full-screen-width"
        style=" background-size: cover;
    background-repeat: no-repeat;
    background-position: center;background-image:linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6)),  url('../img/sfondo.png');">
        <div class="cover__content reveal">
            <h1> Un canile immerso in un suggestivo paesaggio della vallecamonica</h1>
            <h2> Fai del bene, adotta un cane! </h2>
        </div>
    </div>
    <div class="spacer"></div>

    
@endsection
