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
        @foreach ($review_list as $review)
          <!-- Single item -->
          <div class="carousel-item active">
          <p class="text-muted mb-0">{{$review->data}}</p>
          <p class="text-muted mb-0">{{$review->titolo}}</p>
            <p class="lead font-italic mx-4 mx-md-5">
             {{$review->contenuto}}
            </p>
            <div class="mt-5 mb-4">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(2).webp"
                class="rounded-circle img-fluid shadow-1-strong" alt="smaple image" width="100"
                height="100" />
            </div>
            
          </div>
          @endforeach
        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
          data-mdb-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
          data-mdb-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        
      </div>
      <!-- Carousel wrapper -->
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