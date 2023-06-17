@extends('layouts.master') 

@section('titolo')
Insert vaccination
@endsection

@section('stile','style.css') 

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('review.index')}}">Review</a></li>
    <li class="breadcrumb-item active" aria-current="page">New Review</a></li> 
  </ol>
</nav>
@endsection

@section('corpo')

    <div class="container">
      <form method="post" action="{{route('review.store')}}">
            
            @csrf
            <div class="form-group">
                <label for="nome"> Titolo</label>
                <input class="form-control" type="text" id="titolo" name="titolo" placeholder="Titolo">
                @error('titolo')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nome"> Contenuto</label>
                <input class="form-control" type="text" id="contenuto" name="contenuto" placeholder="Contenuto">
                @error('contenuto')
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
            </div>
    
            <div class="form-group">
            <label for="valutazione" class="form-label">Valutazione</label>
    <select class="form-select" id="valutazione" name="valutazione">
     <option value="5">★★★★★ </option>
      <option value="4">★★★★<i class="bi bi-emoji-angry"></i> </option>
      <option value="3">★★★<i class="bi bi-emoji-angry"></i> </option>
      <option value="2">★★<i class="bi bi-emoji-angry"></i> </option>
      <option value="1">★<i class="bi bi-emoji-angry"></i> </option>
    </select>
</div>

<div class="container">
              <a href="{{ route('review.index') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Cancel</a>
      <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Send!</label>
      <input  id="mySubmit" type="submit" value="Create" class="hidden"/>
      </div>
      </form>  
    </div>


@if(Session::has('vaccinationstore'))
  <script>
  swal('Great!' , 'A new vaccination is available for dogs!', "success");
</script>
@endif


@endsection

            
