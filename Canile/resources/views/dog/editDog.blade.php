@extends('layouts.master')


@section('stile')
style.css
@endsection

@section('left_navbar')
<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('home')}}">Home Page</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('dog.index')}}">Tutti i cani</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Adozioni</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Salute dei cani</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Recensioni</a>
                  </li>
                  
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('dog.index')}}">I cani</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</a></li>
       
    </ol>
</nav>
@endsection

@section('corpo')
<div class='row'>
  
    @if(!isset($dog->id))
        <form method="post" action="{{route('dog.store')}}">
            <!--NB ogni volta che uso la form metto @csrf uso per motivi di sicurezza -->
    @else    
        <form method="post" action="{{route('dog.update',['dog' => $dog->id]) }}">
        @method('PUT')
    @endif
        @csrf
        <div class="form-group">
            @if(!isset($dog->id))
                <label for="nome"> Nome</label>
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome"> 
            @else
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome" value="{{$dog->name}}"> 
            @endif
            <br/>
            <label for="razza"> Razza</label>
            <input class="form-control" type="text" id="razza" name="razza" placeholder="Razza"> 

            <br/>

            <div class="form-group">
            <label for="lunghezzapelo">Lunghezza pelo</label>
            <select class="form-control" id="lunghezzapelo" name="lunghezzapelo" placeholder="Lunghezza pelo">
            <option>Corto</option>
            <option>Medio</option>
            <option>Lungo</option>
            </select>
            </div>

            </br>

            <div class="form-group">
            <label for="taglia">Taglia</label>
            <select class="form-control" id="taglia" name="taglia" placeholder="Taglia">
            <option>Piccola</option>
            <option>Media</option>
            <option>Grande</option>
            </select>
            </div>

            <br/>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maschio" value="maschio">
            <label class="form-check-label" for="maschio">Maschio</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femmina" value="femmina">
            <label class="form-check-label" for="femmina">Femmina</label>
            </div>

            <br>

            <!--
            <div class="form-group">
            <label class="active" for="datanascita">Data nascita</label>
            <input type="date" id="dateStandard" name="dateStandard" placeholder="Data nascita" >
            </div>
-->
            


<!-- SISTEMARE DATEPICKER NON VA -->

<!-- https://formden.com/blog/date-picker-->
<div class="container">
   <div class="row">
      <div class='col-sm-6'>
         <div class="form-group">
            <div class='input-group date' id='datetimepicker5'>
               <input type='text' class="form-control" />
               <span class="input-group-addon">
               <span class="glyphicon glyphicon-calendar"></span>
               </span>
            </div>
         </div>
      </div>
      <script type="text/javascript">
         $(function () {
             $('#datetimepicker5').datetimepicker({
                 defaultDate: "11/1/2013",
                 disabledDates: [
                     moment("12/25/2013"),
                     new Date(2013, 11 - 1, 21),
                     "11/22/2013 00:53"
                 ]
             });
         });
      </script>
   </div>
</div>

@endsection