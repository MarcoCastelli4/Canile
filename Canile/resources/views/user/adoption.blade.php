@extends('layouts.master')


@section('stile')
style.css
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('dog.index')}}">Dogs</a></li>
        <li class="breadcrumb-item active" aria-current="page">Adoption</a></li>
        
       
    </ol>
</nav>
@endsection

@section('corpo')
<div class='row'>
  
    <form method="post" action="{{route('user.adoption',['id' => $dog->id]) }}">
        @csrf
        <div id="__enzuzo-root"></div><script id="__enzuzo-root-script" 
        src="https://app.enzuzo.com/__enzuzo-privacy-app.js?mode=tos&apiHost=https://app.enzuzo.com&qt=1683796015307&referral=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJDdXN0b21lcklEIjoyMTU0NCwiQ3VzdG9tZXJOYW1lIjoiY3VzdC00a1lkdlMzSyIsIkN1c3RvbWVyTG9nb1VSTCI6IiIsIlJvbGVzIjpbInJlZmVycmFsIl0sIlByb2R1Y3QiOiJlbnRlcnByaXNlIiwiaXNzIjoiRW56dXpvIEluYy4iLCJuYmYiOjE2ODM3OTYwMTV9.sxKrXuD2yQFdcCqEjW3FFcaMdUIySSq2UxznHF7vq5k">
        </script>
        <label for="accept_terms">
      <input type="checkbox" id="accept_terms" name="accept_terms" required>
      I have read and agree to the privacy policy.
    </label><br><br>
            
      <br/>
      <a href="{{ route('dog.index') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Cancel</a>
            <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i>Adopt!</label>
            <input  id="mySubmit" type="submit" value="Adopt" class="hidden"/>
           
      <form>
</div>
   

@endsection
