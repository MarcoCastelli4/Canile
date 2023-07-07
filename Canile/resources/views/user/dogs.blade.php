@extends('layouts.master') 

@section('titolo')
I miei cani
@endsection

@section('stile','style.css') 

@section('navbar')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">I miei cani</li>
  </ol>
</nav>
@endsection

@section('corpo')

<!-- Se la lista dei cani è vuota oppure non ci sono più cani disponibili -->

@if (count($dog_list)==0)
<div class="alert alert-warning" role="alert">
  <strong>Nessun cane adottato! </strong> Rendi felice qualche amico a quattro zampe!<i class="bi bi-emoji-smile"></i>
</div>
@else
<section class="articles">
                        @foreach($dog_list as $dog)
                        <article>
    <div class="article-wrapper">
    <figure style="display: flex; justify-content: center; align-items: center;">
        @if ($dog->image->count() > 0)
                <img src="{{asset('storage'.$dog->image->first()->path)}}" alt="" />
            @else
                <img src="https://www.stickersmurali.com/it/img/emoji42-jpg/folder/products-listado-merchanthover/adesivi-murali-faccia-di-cane.jpg" width="200px" height="200px" alt="" />
            @endif
        </figure>
        <div class="article-body">
            <h2>{{$dog->nome}}</h2>
            <p>
                <strong>Razza:</strong> {{$dog->razza}} <br>
                <strong>Taglia:</strong>  {{$dog->taglia}} <br>
                <strong>Colore:</strong>  {{$dog->colore}} <br>
                <strong>Lunghezza pelo:</strong>  {{$dog['lunghezza pelo']}} <br>
                <strong>Data di nascita: </strong> {{$dog['data nascita']}} <br>
                <strong>Sesso:</strong>  {{$dog->sesso}} <br>
            </p>
        </div>
    </div>
                                @if($logged==true)
                                <div class="container">
        <table class="table">
          <tr>
           <td><a class="btn btn-info" href="{{ route('dog.info', ['id' => $dog->id]) }}"><i class="bi bi-info-circle"></i> Altro</a></td>
          </tr>
        </table>
      </div>
</article>
 @endif
@endforeach
</section>
                          
                        
                    
              
            @endif
            @endsection

