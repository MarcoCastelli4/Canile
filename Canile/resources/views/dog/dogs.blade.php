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
        <a href="{{ route('vaccination.edit') }}" class="btn btn-success">
    <i class="bi bi-plus-square"></i> Create Vaccination
  </a>
</div>

@endif

<!-- Popup inserimenti corretti -->
@if(Session::has('dogstore'))
  <script>
  swal('Great!' , 'A new dog is available for adoption!', "success");
</script>
@endif

@if(Session::has('dogedit'))
  <script>
  swal('Great!' , 'Dog modified correctly!', "success");
</script>
@endif


@if(Session::has('dogvaccination'))
  <script>
  swal('Great!' , 'Dog vaccination insert correctly!', "success");
</script>
@endif



@if(Session::has('dog_adopted'))
  <script>
  swal('Congratulation!' , 'You are adopted a new dog, check you email box for more details!', "success");
</script>
@endif


<!-- Popup errori -->
@if(Session::has('dog_not_deleted'))
  <script>
  swal('Warning!' , 'You cannot delete a dog if it has been adopted!', "error");
</script>
@endif

@if(Session::has('dog_adoption_error'))
  <script>
  swal('Warning!' , 'Adoption not available for this dog!', "error");
</script>
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
            

<script>


</script>

<script>

// Get the button element
var button = document.getElementById('createVaccinationButton');
// Add a click event listener to the button
button.addEventListener('click', function() {
  var modal = document.getElementById('modalVaccination');
  var bootstrapModal = new bootstrap.Modal(modal);
  bootstrapModal.show();
});
</script>

@endsection