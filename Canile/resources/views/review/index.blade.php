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

@if($logged==true && $isAdmin==false)
<div class="container">
        <a class="btn btn-success" id="createReviewButton">
    <i class="bi bi-card-text"></i></i> Write review
  </a>
</div>
@endif

<!-- Modal per nuova vaccinazione -->
<div class="modal fade" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="modalReview" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Write review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('review.store')}}">
            
            @csrf
            <div class="form-group">
                <label for="nome"> Titolo</label>
                <input class="form-control" type="text" id="titolo" name="titolo" placeholder="Titolo">
            </div>

            <div class="form-group">
                <label for="nome"> Contenuto</label>
                <input class="form-control" type="text" id="contenuto" name="contenuto" placeholder="Contenuto">
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

      </div>
      <div class="modal-footer">
      <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Send!</label>
      <input  id="mySubmit" type="submit" value="Create" class="hidden"/>
      </div>
      </form>
    </div>
  </div>
</div>


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


@section('script')
<script>
  function activateModal() {
  // Get the modal element
  var modal = document.getElementById('modalReview');

  // Activate the modal
  $(modal).modal('show');
}

// Get the button element
var button = document.getElementById('createReviewButton'); 

// Add a click event listener to the button
button.addEventListener('click', activateModal);
    </script>

<script>
  // Get the close button element
  var closeButton = document.querySelector('.modal .close');

  // Add click event listener to the close button
  closeButton.addEventListener('click', function() {
    // Find the modal element
    var modal = document.getElementById('modalReview');

    // Hide the modal by removing the 'show' class
    modal.classList.remove('show');

    // Remove the modal backdrop
    var modalBackdrop = document.querySelector('.modal-backdrop');
    modalBackdrop.parentNode.removeChild(modalBackdrop);

    // Enable scrolling on the body element
    document.body.classList.remove('modal-open');

    // Reload the page
    location.reload();
  });
</script>

@endsection