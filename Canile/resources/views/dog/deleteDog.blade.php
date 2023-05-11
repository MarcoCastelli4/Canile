@extends('layouts.master')

@section('titolo')
Cancellare il cane dal "{{ $dog->name }}" dal database?
@endsection

@section('stile', 'style.css')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('dog.index')}}">I Cani</a></li>
    <li class="breadcrumb-item">Delete</li>
  </ol>
</nav>
@endsection

@section('corpo')
<div class="row">
    <div class="col-md-6">
        <div class="card text-center border-secondary">
            <div class='card-header'>
                Revert
            </div>
            <div class='card-body'>
                <p>The dog <strong>will not be removed</strong> from the database</p>
                <p><a class="btn btn-secondary" href="{{ route('dog.index') }}"><i class="bi-box-arrow-left"></i> Back</a></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-center border-danger">
            <div class='card-header'>
                Confirm
            </div>
            <div class='card-body'>
                <p>The dog <strong>will be removed</strong> from the database</p>
                <p><a class="btn btn-danger" href="{{ route('dog.destroy', ['id' => $dog->id]) }}"><i class="bi-trash3"></i> Remove</a></p>
            </div>
        </div>
    </div>
</div>
@endsection