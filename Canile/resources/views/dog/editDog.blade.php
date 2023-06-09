@extends('layouts.master')

@section('titolo')
Modifica cane
@endsection

@section('stile')
style.css
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('dog.index')}}">I cani</a></li>
        @if(!isset($dog->id))
        <li class="breadcrumb-item active" aria-current="page">Crea</a></li>
        @else
        <li class="breadcrumb-item active" aria-current="page">Aggiorna</a></li>
        @endif
       
    </ol>
</nav>
@endsection

@section('corpo')
<div class='row'>
  
    @if(!isset($dog->id))
        <form method="post" action="{{route('dog.store')}}" enctype="multipart/form-data">
            <!--NB ogni volta che uso la form metto @csrf uso per motivi di sicurezza -->
    @else   
        <form method="post" action="{{route('dog.update',['dog' => $dog->id]) }}" enctype="multipart/form-data">
        <div class="alert alert-warning" role="alert">
        Stai modificando il cane con id: <strong>"{{$dog->id}}"</strong>  e nome: <strong>"{{$dog->nome}}"</strong> 
        </div>
        @method('PUT')
    @endif
        @csrf
            <div class="form-group">
                <label for="nome"> Nome</label>
                @if(!isset($dog->id))
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome" maxlength="30" style="text-transform: capitalize;"> 
            @else
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome" value="{{$dog->nome}}" maxlength="30" style="text-transform: capitalize;"> 
                @endif
                @error('nome')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
               
            </div>
            
            <div class="form-group">
            <label for="razza"> Razza</label>
            @if(!isset($dog->id))
            <input class="form-control" type="text" id="razza" name="razza" placeholder="Razza" maxlength="30" style="text-transform: capitalize;"> 
            @else
            <input class="form-control" type="text" id="razza" name="razza" placeholder="Razza" value="{{$dog->razza}}" maxlength="30" style="text-transform: capitalize;"> 
            @endif
            @error('razza')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
            </div>
            

            <div class="form-group">
            <label for="colore"> Colore</label>
            @if(!isset($dog->id))
            <input  class="form-control" type="text" id="colore" name="colore" placeholder="Colore" maxlength="30" style="text-transform: capitalize;"> 
            @else
            <input  class="form-control" type="text" id="colore" name="colore" placeholder="Colore" value="{{$dog->colore}}" maxlength="30" style="text-transform: capitalize;"> 
            @endif
            @error('colore')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
           
            </div>

            <div class="form-group">
    <label for="lunghezzapelo">Lunghezza pelo</label>
    <select class="form-control" id="lunghezzapelo" name="lunghezzapelo" placeholder="Lunghezza pelo">
        <option {{ isset($dog->id) && $dog['lunghezza pelo'] == 'Corto' ? 'selected' : '' }}>Corto</option>
        <option {{ isset($dog->id) && $dog['lunghezza pelo'] == 'Medio' ? 'selected' : '' }}>Medio</option>
        <option {{ isset($dog->id) && $dog['lunghezza pelo'] == 'Lungo' ? 'selected' : '' }}>Lungo</option>
    </select>
</div>
            <div class="form-group">
    <label for="taglia">Taglia</label>
    <select class="form-control" id="taglia" name="taglia" placeholder="Taglia">
        <option {{ isset($dog->id) && $dog->taglia == 'Piccola' ? 'selected' : '' }}>Piccola</option>
        <option {{ isset($dog->id) && $dog->taglia == 'Media' ? 'selected' : '' }}>Media</option>
        <option {{ isset($dog->id) && $dog->taglia == 'Grande' ? 'selected' : '' }}>Grande</option>
    </select>
</div>


           
            Sesso
            <div class="form-group">
            @if(!isset($dog->id))
            <div class="form-check form-check-inline">
            <input checked class="form-check-input" type="radio" name="sesso" id="maschio" value="maschio">
            <label class="form-check-label" for="maschio">Maschio</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sesso" id="femmina" value="femmina">
            <label class="form-check-label" for="femmina">Femmina</label>
            </div>
            @elseif ($dog->sesso=="femmina")
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sesso" id="maschio" value="maschio">
            <label class="form-check-label" for="maschio">Maschio</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"  checked="true" name="sesso" id="femmina" value="femmina">
            <label class="form-check-label" for="femmina">Femmina</label>
            </div>
            @elseif ($dog->sesso=="maschio")
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" checked="true" name="sesso" id="maschio" value="maschio">
            <label class="form-check-label" for="maschio">Maschio</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sesso" id="femmina" value="femmina">
            <label class="form-check-label" for="femmina">Femmina</label>
            </div>
            @endif
            </div>

        <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="datanascita">Data di nascita</label>
        @if(!isset($dog->id))
        <input class="form-control" id="datanascita" name="datanascita" placeholder="YYY/MM/DD" type="text"/>
        @else
        <input  class="form-control" id="datanascita" name="datanascita" placeholder="YYY/MM/DD" type="text" value="{{$dog['data nascita']}}"/>
        @endif

        @error('datanascita')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
      </div>
      <div class="form-group">
        <label for="images" class="form-label">Upload dog images</label>
        <input class="form-control" id="images" type="file" name="images[]"  multiple accept=".jpg, .jpeg, .png"/>
</div>
<div class="form-group">
        <label for="documents" class="form-label">Upload dog documents</label>
        <input class="form-control" id="documents" type="file"  name="documents[]"  multiple accept=".pdf" />
        </div>
      <br/>
      <div class="container">
      <a href="{{ route('dog.index') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Annulla</a>
            @if(isset($dog->id))
            <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Aggiorna</label>
            <input id="mySubmit" type="submit" value="Update" class="hidden"/>
            @else
            <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Crea</label>
            <input  id="mySubmit" type="submit" value="Create" class="hidden"/>
            @endif
    </div>

           
      <form>
</div>
   

@endsection
@section('script')
    <script>
    $(document).ready(function(){
        var date_input=$('input[name="datanascita"]'); //our date input has the name "datanascita"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
            endDate: "today", 
        })
    })
</script>

@endsection
