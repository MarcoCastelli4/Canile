@extends('layouts.master')

@section('stile')
style.css
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Review</a></li> 
    </ol>
</nav>
@endsection

@section('corpo')

@if(Session::has('review_store'))
  <script>
  swal('Well Done!' , 'Review insert correctly!', "success");
</script>
@endif

@if($logged==true && $isAdmin==false)
<div class="container">
  <a href="{{ route('review.edit') }}" class="btn btn-success">
    <i class="bi bi-plus-square"></i> Write Review
  </a>
</div>
@endif

</div>
<div class="row text-center">
  <div class="col-md-12">
    <!-- Carousel wrapper -->
    <div id="carouselBasicExample" class="carousel slide carousel-dark" data-mdb-ride="carousel">
      <!-- Inner -->
      <div class="carousel-inner">
        @foreach ($review_list as $key => $review)
        <!-- Single item -->
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
        <p class="text-muted mb-2"><strong>{{$review->data}}</strong></p>
          <h5 class="mb-4">{{$review->titolo}}</h5>
          <p class="lead font-italic mx-4 mx-md-5">
            {{$review->contenuto}}
          </p>

          
          <div class="mt-5 mb-4">
            @if($review->valutazione==1)
            <i class="bi bi-emoji-angry" style="font-size: 100px;"></i>
            @elseif($review->valutazione==2)
            <i class="bi bi-emoji-frown" style="font-size: 100px;"></i>
            @elseif($review->valutazione==3)
            <i class="bi bi-emoji-expressionless" style="font-size: 100px;"></i>
            @elseif($review->valutazione==4)
            <i class="bi bi-emoji-smile" style="font-size: 100px;"></i>
            @elseif($review->valutazione==5)
            <i class="bi bi-emoji-heart-eyes" style="font-size: 100px;"></i>
            @endif
          </div>
        </div>
        @endforeach
      </div>
      <!-- Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselBasicExample"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselBasicExample"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    </div>
  </div>

@endsection


