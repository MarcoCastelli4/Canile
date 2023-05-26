@extends('layouts.master') 

@section('titolo')
The dogs
@endsection

@section('stile','style.css') 

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">I cani</li>
  </ol>
</nav>
@endsection

@section('corpo')

@if($isAdmin==true)
<div class="container">
        <a href="{{ route('dog.create') }}" class="btn btn-success">  <i class="bi bi-plus-square"></i> Create new dog</a> <!--btn:bottone, btn-success: bottone verde-->
        </td>
        <a class="btn btn-success" id="createVaccinationButton">
    <i class="bi bi-plus-square"></i> Create Vaccination
  </a>
</div>

<!-- Modal per nuova vaccinazione -->
<div class="modal fade" id="modalVaccination" tabindex="-1" role="dialog" aria-labelledby="modalVaccination" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create vaccination</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('vaccination.store')}}">
            
            @csrf
            <div class="form-group">
                <label for="nome"> Malattia</label>
                <input class="form-control" type="text" id="malattia" name="malattia" placeholder="Malattia">
            </div>

            <div class="form-group">
                <label for="nome"> Validità</label>
                <input class="form-control" type="number" id="validità" name="validità" placeholder="Validità (mesi)">
            </div>
    

      </div>
      <div class="modal-footer">
      <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Create</label>
      <input  id="mySubmit" type="submit" value="Create" class="hidden"/>
      </div>
      </form>
    </div>
  </div>
</div>


</div>

@endif

<!-- Se la lista dei cani è vuota oppure non ci sono più cani disponibili -->

@if (count($dog_list)==0)
<div class="alert alert-warning" role="alert">
  @if($isAdmin==true)
  <strong>No dog are available in database! </strong>Please create new dog with the button above!
  @else
  <strong>No dog are available! </strong> Please contact service!
  @endif
</div>
@else
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-responsive" style="width:100%">
                        <col width='10%'>
                        <col width='10%'>
                        <col width='10%'>
                        <col width='10%'>
                        <col width='10%'>
                        <col width='10%'>
                        <col width='10%'>
                        <col width='10%'>
                        <col width='10%'>
                        <col width='10%'>
                        
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Razza</th>
                                <th>Taglia</th>
                                <th>Colore</th>
                                <th>Pelo</th>
                                <th>Età</th>
                                <th>Sesso</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                        @foreach($dog_list as $dog)
                            <tr>
                                <td>{{$dog->nome}}</td>
                                <td>{{$dog->razza}}</td>
                                <td>{{$dog->taglia}}</td>
                                <td>{{$dog->colore}}</td>
                                <td>{{$dog['lunghezza pelo']}}</td>
                                <td>{{$dog['data nascita']}}</td>
                                <td>{{$dog->sesso}}</td>
                               
                                @if($logged==true)
                                @if($isAdmin==true)
                                <td>
                                    <a class="btn btn-primary"  href="{{ route('dog.edit', ['dog' => $dog->id]) }}">
                                    <i class="bi-pencil-square"></i> Edit</a>
                                </td>
                                <td>
                            <a class="btn btn-danger" 
                                href="{{ route('dog.destroy.confirm', ['id' => $dog->id]) }}"><i class="bi-trash3"></i> Delete</a>
                            </td>
                            
                              
                                <td>
                            <a class="btn btn-success" href="{{ route('dog.vaccination', ['id' => $dog->id]) }}"><i class="bi bi-virus"></i> Vaccination</a>
                                </td>
                                @else
                              <td>
                      
                             <a class="btn adoptionBtn" href="{{ route('user.adoption', ['id' => $dog->id]) }}"><span><img src="../img/adopt.png" width="48" height="48" /></span></a>
                              </td>
                              @endif
                              @endif
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

@section('script')
<script>
  function activateModal() {
  // Get the modal element
  var modal = document.getElementById('modalVaccination');

  // Activate the modal
  $(modal).modal('show');
}

// Get the button element
var button = document.getElementById('createVaccinationButton'); 

// Add a click event listener to the button
button.addEventListener('click', activateModal);
    </script>

<script>
  // Get the close button element
  var closeButton = document.querySelector('.modal .close');

  // Add click event listener to the close button
  closeButton.addEventListener('click', function() {
    // Find the modal element
    var modal = document.getElementById('modalVaccination');

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