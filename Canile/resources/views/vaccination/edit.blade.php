@extends('layouts.master') 

@section('titolo')
Insert vaccination
@endsection

@section('stile','style.css') 

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('dog.index')}}">I cani</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nuova malattia</li>
  </ol>
</nav>
@endsection

@section('corpo')

    <div class="container">
      <form method="post" id="modalForm" action="{{route('vaccination.store')}}">
            
            @csrf
            <div class="form-group">
                <label for="nome"> Malattia</label>
                <input class="form-control" type="text" id="malattia" name="malattia" placeholder="Malattia">
                @error('malattia')
                <div id="modal_error" class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
              </div>

            <div class="form-group">
                <label for="nome"> Validità</label>
                <input  class="form-control" type="number" id="validita" name="validita" placeholder="Validità (mesi)">
                @error('validita')
                <div id="modal_error" class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
              </div>
              <div class="container">
              <a href="{{ route('dog.index') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Cancel</a>
      <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Create</label>
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
</div>
</div>
            

