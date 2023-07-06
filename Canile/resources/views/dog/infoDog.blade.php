@extends('layouts.master') 

@section('titolo')
Informazioni cane
@endsection

@section('stile','style.css') 

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('dog.index')}}">I cani</a></li>
        <li class="breadcrumb-item active" aria-current="page">Informazioni</a></li>
    </ol>
</nav>
@endsection



@section('corpo')
<h3> Informazioni mediche e documentazione relativa a: {{$dog->nome}} </h3>

<div class="row justify-content-center align-items-center">
  <div class="col-md-4">
    <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach ($images as $index => $image)
          <div class="carousel-item{{ $index == 0 ? ' active' : '' }} text-center">
            <img src="{{ asset('storage'.$image->path) }}" style="width: 100%; height: auto; object-fit: cover; display: inline-block;">
          </div>
        @endforeach
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Precedente</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Successiva</span>
      </button>
    </div>
  </div>
</div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-responsive" style="width:100%">
                        <col width='10%'>
                        <col width='10%'>
                        
                        <thead>
                            <tr>
                                <th>Vaccinazioni</th>
                                <th>Documentazione</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <tr>
                                <td>
                                @foreach ($dog->vaccination as $v)
                                {{ $v->malattia }}
                                 {{$v->pivot->data}}
                                 <br/>
                                 @endforeach
                                </td>
                                <td>
                                @foreach ($documents as $d)
                                <a>{{ $d->titolo }}</a> &nbsp&nbsp<i class="bi bi-download"><a href="{{asset('storage'.$d->path)}}" download="{{ $d->titolo }}">&nbsp&nbspDownload</a></i>
                                 <br/>
                                 @endforeach
                                </td>
                            </tr>    
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
@endsection
