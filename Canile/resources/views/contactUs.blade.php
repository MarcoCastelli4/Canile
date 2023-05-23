@extends('layouts.master') 

@section('titolo')
Contact Us
@endsection

@section('stile','style.css') 

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
  </ol>
</nav>
@endsection

@section('corpo')
<div class="colums">
          <div class="column">
            <br/><br/><br/><br/>
            <img src="img/logob.png" class="img-responsive" width="200"  height="200" >
          </div>

          <div class="column">
            <br/><br/><br/>
            </i> Canile Boscoverde<br/>
            Parco Del Lago Moro 25047 Darfo Boario Terme
            CF: 90049020093
            <br/><br/><br/>
            <i class="bi bi-telephone">&nbsp+39 0364 331944</i>
            <br/>
            <br/>
            <i class="bi bi-envelope-fill">&nbspCanileBoscoverde@email.com</i>
          </div>

          <div class="column">
            <br/>
            Seguici su:
            <br/>
            <i class="bi bi-facebook" style="font-size: 50px;">
              &nbsp
            </i><i class="bi bi-instagram" style="font-size: 50px;"></i>

            <br/>
            <br/>
            Orario:
            <br/>
            Lunedì: 10-14
            <br/>
            Martedi: 10-18
            <br/>
            Mercoledì: chiuso
            <br/>
            Giovedì: 10-18
            <br/>
            Sabato: 12-18
            <br/>
            Domenica: chiuso

@endsection