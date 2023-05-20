@extends('layouts.master')


@section('stile')
style.css
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('dog.index')}}">Dogs</a></li>
        @if(!isset($dog->id))
        <li class="breadcrumb-item active" aria-current="page">Add</a></li>
        @else
        <li class="breadcrumb-item active" aria-current="page">Edit</a></li>
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
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome"> 
            @else
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome" value="{{$dog->nome}}"> 
            @endif
            </div>
            
            <div class="form-group">
            <br/>
            <label for="razza"> Razza</label>
            @if(!isset($dog->id))
            <input class="form-control" type="text" id="razza" name="razza" placeholder="Razza"> 
            @else
            <input class="form-control" type="text" id="razza" name="razza" placeholder="Razza" value="{{$dog->razza}}"> 
            @endif
            </div>
            <br/>

            <div class="form-group">
            <label for="colore"> Colore</label>
            @if(!isset($dog->id))
            <input class="form-control" type="text" id="colore" name="colore" placeholder="Colore"> 
            @else
            <input class="form-control" type="text" id="colore" name="colore" placeholder="Colore" value="{{$dog->colore}}"> 
            @endif
            <br/>
            </div>

            <div class="form-group">
            <label for="lunghezzapelo">Lunghezza pelo</label>
            @if(!isset($dog->id))
            <select class="form-control" id="lunghezzapelo" name="lunghezzapelo" placeholder="Lunghezza pelo">
            @else
            <select class="form-control" id="lunghezzapelo" name="lunghezzapelo" placeholder="Lunghezza pelo" value="{{$dog['lunghezza pelo']}}">
            @endif
            <option>Corto</option>
            <option>Medio</option>
            <option>Lungo</option>
            </select>
            </div>

            </br>

            <div class="form-group">
            <label for="taglia">Taglia</label>
            @if(!isset($dog->id))
            <select class="form-control" id="taglia" name="taglia" placeholder="Taglia">
            @else
            <select class="form-control" id="taglia" name="taglia" placeholder="Taglia" value="{{$dog->taglia}}">
            @endif
            <option>Piccola</option>
            <option>Media</option>
            <option>Grande</option>
            </select>
            </div>

            <br/>
            Sesso
            <br/>
            <div class="form-group">
            @if(!isset($dog->id))
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sesso" id="maschio" value="maschio">
            <label class="form-check-label" for="maschio">Maschio</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sesso" id="femmina" value="femmina">
            <label class="form-check-label" for="femmina">Femmina</label>
            </div>
            @elseif ($dog->sesso=="Femmina")
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sesso" id="maschio" value="maschio">
            <label class="form-check-label" for="maschio">Maschio</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"  checked="true" name="sesso" id="femmina" value="femmina">
            <label class="form-check-label" for="femmina">Femmina</label>
            </div>
            @elseif ($dog->sesso=="Maschio")
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


            <br/>

        <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="datanascita">Data di nascita</label>
        @if(!isset($dog->id))
        <input class="form-control" id="datanascita" name="datanascita" placeholder="YYY/MM/DD" type="text"/>
        @else
        <input class="form-control" id="datanascita" name="datanascita" placeholder="YYY/MM/DD" type="text" value="{{$dog['data nascita']}}"/>
        @endif
      </div>
      <br/>
        <label for="images" class="form-label">Upload dog images</label>
        <input class="form-control" id="images" type="file" name="images[]"  multiple />

        <br/>
        <label for="docuemnts" class="form-label">Upload dog documents</label>
        <input class="form-control" id="documents" type="file"  name="documents[]"  multiple />

      <br/>
      <a href="{{ route('dog.index') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Cancel</a>
            @if(isset($dog->id))
            <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Update</label>
            <input id="mySubmit" type="submit" value="Update" class="hidden"/>
            @else
            <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Create</label>
            <input  id="mySubmit" type="submit" value="Create" class="hidden"/>
            @endif


           
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
