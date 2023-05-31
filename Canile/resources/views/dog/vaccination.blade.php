@extends('layouts.master') 

@section('titolo')
Vaccination dog
@endsection

@section('stile','style.css') 

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('dog.index')}}">Dogs</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add vaccination</a></li>
    </ol>
</nav>
@endsection

@section('corpo')
        <form method="post" action="{{route('dog.vaccination',['id' => $dog->id])}}">
            
            @csrf
            <div class="form-group">
                <label for="nome"> Nome</label>
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome" value="{{$dog->nome}}" disabled>
            </div>
            
            <div class="form-group">
            <label for="vaccination_id">Malattia</label>
            <select class="form-control" id="vaccination_id" name="vaccination_id" placeholder="vaccination_id">
            @foreach ($vaccination_list as $v)
            <option value="{{$v->id}}">{{$v->malattia}}</option> <!-- mostro malattia ma invio l'id !-->
            @endforeach
            </select>
            </div>

        <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="dataVaccinazione">Data vaccinazione</label>
        <input required class="form-control" id="dataVaccinazione" name="dataVaccinazione" placeholder="YYY/MM/DD" type="text"/>
      </div>

      <br/>
      <div class="container">
      <a href="{{ route('dog.index') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Cancel</a>
      <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Insert</label>
            <input  id="mySubmit" type="submit" value="Insert" class="hidden"/>
</div>
      <form>
</div>  
@endsection

@section('script')
    <script>
    $(document).ready(function(){
        var date_input=$('input[name="dataVaccinazione"]');
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
