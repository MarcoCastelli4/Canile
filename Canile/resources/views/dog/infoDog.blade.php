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

<div style="display: flex;">
                    <table class="table table-striped table-hover table-responsive" style="width:100%; display: inline-block;">
                        <col width='10%'>
                        
                        <thead>
                            <tr>
                                <th>Vaccinazioni <br><a style="font-weight: normal !important;"> Legenda:</a> &nbsp<a style="color:red;">Scaduta </a>&nbsp<a style="color:orange;"> In scadenza </a>&nbsp<a style="color:green;"> Valida</a></th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <tr>
                                <td>
                                @foreach ($dog->vaccination->sortByDesc(function ($v) {
    return \Carbon\Carbon::parse($v->pivot->data);
}) as $v)
     @php
     $existingDate = $v->pivot->data;
        $numberOfMonths = $v->validità;
        $carbonDate = \Carbon\Carbon::parse($existingDate);
        $newDate = $carbonDate->addMonths($numberOfMonths);
        $isBeforeCurrentDate = $newDate->isBefore(\Carbon\Carbon::now());
        $isBetweenDates = $newDate->isBetween(\Carbon\Carbon::now()->addDays(10), \Carbon\Carbon::now(), true);
        $scaduta = $isBeforeCurrentDate;
        $inScadenza = $isBetweenDates;
    @endphp

    @if ($scaduta)
    <div style="color:red;">&#9632;
    @elseif($inScadenza)
    <div style="color:orange;">&#9632;
    @elseif (!$inScadenza)
    <div style="color:green;">&#9632;
    @endif

    <a style="color:black">
    {{ $v->malattia }}
    {{ $v->pivot->data }}
    </a>
    </div>
    <br/>
    


@endforeach

                                 
                                
                                </td>
                        </tbody>
                    </table>

                    <table class="table table-striped table-hover table-responsive" style="width:100%; display: inline-block;">
                        <col width='10%'>
                        
                        <thead>
                            <tr>
                                <th>Documentazione <br><a style="font-weight: normal !important;">Qui è presente tutta la documentazione relativa al cane</a></th>                                
                            </tr>
                        </thead>
                       
                        <tbody>
                            <tr>
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
           
            
@endsection
