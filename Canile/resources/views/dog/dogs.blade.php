@extends('layouts.master') 

@section('titolo')
I cani
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
        <a href="{{ route('dog.create') }}" class="btn btn-success">  <i class="bi bi-plus-square"></i> Crea nuovo cane</a> <!--btn:bottone, btn-success: bottone verde-->
        </td>
        <a href="{{ route('vaccination.edit') }}" class="btn btn-success">
    <i class="bi bi-plus-square"></i> Crea vaccinazione
  </a>
</div>

@endif

<!-- Popup inserimenti corretti -->
@if(Session::has('dogstore'))
  <script>
  swal('Ben fatto!' , 'Un nuovo cane è disponibile nel canile!', "success");
</script>
@endif

@if(Session::has('dogedit'))
  <script>
  swal('Ben fatto!' , 'Cane modificato correttamente!', "success");
</script>
@endif


@if(Session::has('dogvaccination'))
  <script>
  swal('Ben fatto!' , 'Cane vaccinato!', "success");
</script>
@endif



@if(Session::has('dog_adopted'))
  <script>
  swal('Congratulazioni!' , 'Hai adottato un cane del nostro canile! Controlla la tua email per maggiori dettagli!', "success");
</script>
@endif

@if(Session::has('dog_deleted'))
  <script>
  swal('Nessun problema!' , 'Cane eliminato correttamente!', "success");
</script>
@endif

@if(Session::has('vaccinationstore'))
  <script>
  swal('Ben fatto!' , 'Nuova vaccinazione disponibile per i cani!', "success");
</script>
@endif

<!-- Popup errori -->
@if(Session::has('dog_not_deleted'))
  <script>
  swal('Attenzione!' , 'Non puoi cancellare un cane che è stato adottato!', "error");
</script>
@endif

@if(Session::has('dog_adoption_error'))
  <script>
  swal('Attenzione!' , 'Adozione non disponibile per il cane!', "error");
</script>
@endif

@if(Session::has('id_dog_fail'))
  <script>
  swal('Attenzione!' , 'Stai usando un dog id non valido!', "error");
</script>
@endif

@if(Session::has('id_user_fail'))
  <script>
  swal('Attenzione!' , 'Questo non è il tuo id!', "error");
</script>
@endif


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filtri</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
      Scegli un filtro per visualizzare i cani
    </div>
    <div class="dropdown mt-3">

      @php
      if(is_object($lista_razze)){
        $uniqueRazza = $lista_razze->unique();
    } else if(is_array($lista_razze)){
        $uniqueRazza = collect($lista_razze)->unique();
    } else {
        $uniqueRazza = collect([]);
    }
      $uniqueTaglia = array( "Piccola", "Media","Grande");
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
<div class="container">
  <button type="submit" class="btn btn-outline-warning"  data-bs-dismiss="offcanvas">Filter</button>
  <button type="submit" class="btn btn-outline-success"  data-bs-dismiss="offcanvas" onClick="resetFilter()">Reset Filter</button>
</div>
</form>

    </div>
  </div>
</div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div class="container d-flex justify-content-center align-items-center">
  <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn btn-default">
    <i class="bi bi-filter"></i> Filtra i cani
  </a>

  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Ordina
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item ordina" >Cuccioli</a>
      <a class="dropdown-item ordina" >Anziani</a>
    </div>
  </div>
</div>


    </div>

    <!-- Se la lista dei cani è vuota oppure non ci sono più cani disponibili -->
@if (count($dog_list)==0)
<div class="alert alert-warning" role="alert">
  @if($isAdmin==true)
  <strong>Nessun cane disponibile nel database! </strong>Per favore, crea un cane tramite il bottone apposito!
  @else
  <strong>Nesssun cane disponibile! </strong> Resetta i filtri oppure contatta la direzione!
  @endif
</div>
@endif

    @if (count($dog_list)>0)
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
    @if($isAdmin==true)
      <div class="container">
        <table class="table">
          <tr>
            <td><a class="btn btn-primary" href="{{ route('dog.edit', ['dog' => $dog->id]) }}"><i class="bi-pencil-square"></i> Modifica</a></td>
            <td><a class="btn btn-danger" href="{{ route('dog.destroy.confirm', ['id' => $dog->id]) }}"><i class="bi-trash3"></i> Elimina</a></td>
            <td><a class="btn btn-success" href="{{ route('dog.vaccination', ['id' => $dog->id]) }}"><i class="bi bi-virus"></i> Vaccina</a></td>
          </tr>
        </table>
      </div>
      <div class="container">
    <table class="table">
      <tr>
        <td><a class="btn btn-info" href="{{ route('dog.info', ['id' => $dog->id]) }}"><i class="bi bi-info-circle"></i> Altro</a></td>
      </tr>
    </table>
  </div>
  @endif

  @if($logged==true  && $isAdmin==false)
  <div class="container">
        <table class="table">
          <tr>
           <td><a class="btn adoptionBtn" href="{{ route('user.adoption', ['id' => $dog->id]) }}"><span><img src="../img/adopt.png" width="48" height="48" /></span></a></td>
           <td><a class="btn btn-info" href="{{ route('dog.info', ['id' => $dog->id]) }}"><i class="bi bi-info-circle"></i> Altro</a></td>
          </tr>
        </table>
      </div>
  @elseif ($logged==false)
  <div class="container">
        <table class="table">
          <tr>
           <td><a class="btn btn-info" href="{{ route('dog.info', ['id' => $dog->id]) }}"><i class="bi bi-info-circle"></i> Altro</a></td>
          </tr>
        </table>
      </div>
  @endif
  

  
</article>

  @endforeach
  @endif
  </section>

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
  // per i filtri
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
      var taglia = $("#taglia-filter").val();
      var pelo = $("#pelo-filter").val();
      var sesso = $("#sesso-filter").val();

      // invio richiesta ajax
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      console.log(razza);
      $.ajax({
        url: '/dog/filter',
        method: 'GET',
        data: { filterRazza: razza, filterTaglia:taglia, filterPelo:pelo, filterSesso:sesso },
        success: function(response) {
          var newDocument = document.open('text/html', 'replace');
          newDocument.write(response);
          newDocument.close();
        },
        error: function(xhr, status, error) {
          // Handle any errors that occur during the AJAX request
          console.error(error);
          console.log("Errore");
        }
      });
    });

  });

  function resetFilter() {
    window.location.reload();

    // Select all the select elements in the form
    var selects = document.querySelectorAll('#razza-filter, #taglia-filter, #sesso-filter, #pelo-filter');

    // Reset the selected values for each select element
    selects.forEach(function(select) {
      select.selectedIndex = -1; // Reset to no selected option
    });
  }
</script>

<script>
  $(document).ready(function() {
    $('.ordina').click(function() {
    var selectedValue = $(this).text().trim();
    console.log('Selected value: ' + selectedValue);

    // Perform AJAX request with the selected value
    // Here, you can make an AJAX request to send the selected value to the server or perform any other actions.
    // You can use the $.ajax() function or any other AJAX method provided by jQuery.
    // Example:
   // invio richiesta ajax
   $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: '/dog/order',
        method: 'GET',
        data: { valore: selectedValue },
        success: function(response) {
          var newDocument = document.open('text/html', 'replace');
          newDocument.write(response);
          newDocument.close();
        },
        error: function(xhr, status, error) {
          // Handle any errors that occur during the AJAX request
          console.error(error);
          console.log("Errore");
        }
      });
  });
});

</script>

@endsection