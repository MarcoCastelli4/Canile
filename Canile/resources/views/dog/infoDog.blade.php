@extends('layouts.master') 

@section('titolo')
I cani
@endsection

@section('stile','style.css') 

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
                    <a class="nav-link" aria-current="page" href="">Salute dei cani</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Recensioni</a>
                  </li>
                  
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('dog.index')}}">Dogs</a></li>
        <li class="breadcrumb-item active" aria-current="page">Medical and other information</a></li>
    </ol>
</nav>
@endsection

@section('corpo')
<div class="row">
  <!-- 
    <div class="col-xs-6">   
  
        <a href="{{ route('dog.create') }}" class="btn btn-success">  <i class="bi bi-plus-square"></i> Create new dog</a> 
      </div> 
    -->
</div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-responsive" style="width:100%">
                        <col width='10%'>
                        <col width='10%'>
                        
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Vaccinazioni</th>
                                <th>Fotografie</th>
                                <th>Documentazione</th>
                                <!--<th>Documentazione</th>-->
                            </tr>
                        </thead>
                       
                        <tbody>
                            <tr>
                                <td>{{$dog->nome}}</td> 
                                <td>
                                @foreach ($dog->vaccination as $v)
                                {{ $v->malattia }}
                                 {{$v->pivot->data}}
                                 <br/>
                                 @endforeach
                                </td>
                                <td></td>
                                <td>
                                  <!--credo fara lezione per gestire pdf o img nel database-->
                                <a href="C:\Users\Marco Castelli\Desktop\Documenti\ricevutaPesca.pdf" download="prova.pdf">Download</a>
                                </td>
                                <!--
                                <td>
                                    <a class="btn btn-primary"  href="{{ route('dog.edit', ['dog' => $dog ->id]) }}">
                                    <i class="bi-pencil-square"></i> Edit</a>
                                </td>
                                <td>
                            <a class="btn btn-danger" 
                                href="{{ route('dog.destroy.confirm', ['id' => $dog->id]) }}"><i class="bi-trash3"></i> Delete</a>
                                </td>-->
                            </tr>
                          
                       
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
@endsection

