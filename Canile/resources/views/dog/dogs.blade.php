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

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
      Choose filter to view dogs.
    </div>
    <div class="dropdown mt-3">

      @php
      $uniqueRazza = $dog_list->pluck('razza')->unique();
      $uniqueTaglia = $dog_list->pluck('taglia')->unique();
      $uniquePelo = array( "Corto", "Medio","Lungo");
      $uniqueSesso = array( "maschio", "femmina");
      @endphp

      <form>
      <div class="table-container">
  <table class="table">
    <thead>
      <tr class="filtro-razza">
        <th>
          <i class="bi bi-plus-circle"></i> Razza <span class="caret"></span>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="razza">
        <td>
          <div class="form-group">
            <select class="form-control" name="razza-filter" id="razza-filter" multiple>
              @foreach($uniqueRazza as $razza)
              <option value="{{ $razza }}">{{ $razza }}</option>
              @endforeach
            </select>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <table class="table">
    <thead>
      <tr class="filtro-taglia">
        <th>
          <i class="bi bi-plus-circle"></i> Taglia <span class="caret"></span>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="taglia">
        <td>
          <div class="form-group">
            <select class="form-control" name="taglia-filter" id="taglia-filter" multiple>
              @foreach($uniqueTaglia as $t)
              <option value="{{ $t }}">{{ $t }}</option>
              @endforeach
            </select>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <table class="table">
    <thead>
      <tr class="filtro-sesso">
        <th>
          <i class="bi bi-plus-circle"></i> Sesso <span class="caret"></span>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="sesso">
        <td>
          <div class="form-group">
            <select class="form-control" name="sesso-filter" id="sesso-filter" multiple>
              @foreach($uniqueSesso as $sesso)
              <option value="{{ $sesso }}">{{ $sesso }}</option>
              @endforeach
            </select>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  <table class="table">
    <thead>
      <tr class="filtro-pelo">
        <th>
          <i class="bi bi-plus-circle"></i> Lunghezza pelo <span class="caret"></span>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="pelo">
        <td>
          <div class="form-group">
            <select class="form-control" name="pelo-filter" id="pelo-filter" multiple>
              @foreach($uniquePelo as $p)
              <option value="{{ $p }}">{{ $p }}</option>
              @endforeach
            </select>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
  <button type="submit" class="btn btn-outline-warning"  data-bs-dismiss="offcanvas">Filter</button>
</form>

    </div>
  </div>
</div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div class="container">
  <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn btn-default">
  <i class="bi bi-filter"></i>Filter Dog
  </a>
</div>
    </div>

       
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-responsive lista" style="width:100%">
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
            </div>

<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
</script>


<script>
  //nascondo tabella per filtri
    $(document).ready(function() {
        $("tr[class=razza]").each(function() {
            $(this).hide();
        });
        $("tr[class=sesso]").each(function() {
            $(this).hide();
        });
        $("tr[class=pelo]").each(function() {
            $(this).hide();
        });
        $("tr[class=taglia]").each(function() {
            $(this).hide();
        });
    });
    // quando clicco icona si aprono
    $(".filtro-razza th i").each(function() {
            $(this).click(function() {
                $("tr[class=razza]").each(function() {
                    $(this).toggle();
                });
            });
        });
        $(".filtro-taglia th i").each(function() {
            $(this).click(function() {
                $("tr[class=taglia]").each(function() {
                    $(this).toggle();
                });
            });
        });
        $(".filtro-sesso th i").each(function() {
            $(this).click(function() {
                $("tr[class=sesso]").each(function() {
                    $(this).toggle();
                });
            });
        });$(".filtro-pelo th i").each(function() {
            $(this).click(function() {
                $("tr[class=pelo]").each(function() {
                    $(this).toggle();
                });
            });
        });
</script>

<script>
    // converto la variable dog_list per essere accessibile al javascript
    var dog_list_js = {!! json_encode($dog_list) !!};

  $(document).ready(function() {

    $("select").change(function() {
      var selectedValues = $(this).val();
      $("select").not(this).each(function() {
        var currentValue = $(this).val();
        $(this).val(selectedValues.concat(currentValue));
      });
    });

    // Handle form submission
    $("form").submit(function(event) {
      event.preventDefault(); // Prevent the form from submitting
      
      
      // Get the filter values
      var razza = $("#razza-filter").val();
      // Check if selectedRazza is null or empty
      if (!razza || razza.length === 0) {
        // If no values are selected, consider all razza values as selected
            razza = dog_list_js.map(function(dog) {
             return dog.razza;
         });
        }
      var taglia = $("#taglia-filter").val();
      // Check if selectedTagla is null or empty
      if (!taglia || taglia.length === 0) {
        // If no values are selected, consider all razza values as selected
        taglia = dog_list_js.map(function(dog) {
             return dog.taglia;
         });
        }
      var pelo = $("#pelo-filter").val();
      // Check if selectedPelo is null or empty
      if (!pelo || pelo.length === 0) {
        // If no values are selected, consider all razza values as selected
        pelo = dog_list_js.map(function(dog) {
             return dog.pelo;
         });
        }
      var sesso = $("#sesso-filter").val();
      // Check if selectedSesso is null or empty
      if (!sesso || sesso.length === 0) {
        // If no values are selected, consider all razza values as selected
        sesso = dog_list_js.map(function(dog) {
             return dog.sesso;
         });
        }

      // Call a function to update the dog list
      var filteredDogList = filterDogs(razza, taglia, pelo, sesso);

      // invio richiesta ajax
      $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      $.ajax({
      url: "/update-dog-list",
      type: "POST",
      data: { dogList: filteredDogList },
      success: function(response) {
        // Handle the success response from the server, if needed
        console.log(response);
        console.log("Corretto");
        //window.location.href = window.location.href;
        updatePage(response.dog_list);
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the AJAX request
        console.error(error);
        console.log("Errore");
      }
    });
    });
    
    // Function to update the dog list
    function filterDogs(razza, taglia, pelo, sesso) {
      return dog_list_js.filter(function(dog) {
        // Apply the filter conditions
        return (
          (razza.length === 0 || razza.includes(dog.razza)) &&
          (taglia.length === 0 || taglia.includes(dog.taglia)) &&
          (pelo.length === 0 || pelo.includes(dog.pelo)) &&
          (sesso.length === 0 || sesso.includes(dog.sesso))
        );
      });
    }
  });

  function updatePage(dogList) {
  // Perform the necessary DOM manipulation to update the page
  // For example, update a table with the new dog_list

  // Assuming you have a table element with id "dogTable"
  var table = $("#lista");
  table.empty(); // Clear existing data from the table

  // Iterate over the dogList and populate the table with the updated data
  for (var i = 0; i < dogList.length; i++) {
    var dog = dogList[i];
    // Append a new row to the table with the dog details
    var row = "<tr><td>" + dog.name + "</td><td>" + dog.razza + "</td></tr>";
    table.append(row);
  }
}
</script>

@endsection