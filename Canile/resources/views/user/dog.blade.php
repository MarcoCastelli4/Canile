@extends('layouts.master') 

@section('titolo')
The dogs
@endsection

@section('stile','style.css') 

@section('navbar')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">My Dogs</li>
  </ol>
</nav>
@endsection

@section('corpo')

<!-- Se la lista dei cani è vuota oppure non ci sono più cani disponibili -->

@if (count($dog_list)==0)
<div class="alert alert-warning" role="alert">
  <strong>You haven't adopted any dogs yet! </strong> Make some four-legged friends happy!<i class="bi bi-emoji-smile"></i>
</div>
@else
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-responsive" style="width:100%">
                        <col width='30%'>
                        <col width='30%'>
                        
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Razza</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                        @foreach($dog_list as $dog)
                            <tr>
                                <td>{{$dog->nome}}</td>
                                <td>{{$dog->razza}}</td>
                                @if($logged==true)
                              <td>
                            <a class="btn btn-info" href="{{ route('dog.info', ['id' => $dog->id]) }}"><i class="bi bi-info-circle"></i> More</a>
                                </td>
                            </tr>
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
            

@endsection
