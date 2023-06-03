<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('titolo')</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, 
              user-scalable=no">

        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">

        <!-- Option 1: Include in HTML -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <!-- jQuery e plugin JavaScript  -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap Date-Picker Plugin -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">


        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
    
          <div id="mainNavigation">
	      <nav role="navigation">
		  <div class="logo-container"></div>
	      </nav>
	      <div class="navbar-expand-md" id="navbar">
	        <div class="navbar-dark text-center my-2">
	          <button class="navbar-toggler w-75" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="navbar-toggler-icon"></span> <span class="align-middle">Menu</span>
	          </button>
	        </div>
	        <div class="text-center mt-3 collapse navbar-collapse" id="navbarNavDropdown">
	          <ul class="navbar-nav mx-auto ">
	            <li class="nav-item">
	              <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link" href="{{route('dog.index')}}"> Dogs</a>
	            </li>
              
@if($logged)
@if($isAdmin==0)
<li class="nav-item">
    <a class="nav-link" href="{{route('user.dogs',['id' => $user_id])}}"> My Dogs</a>
</li>
@endif
@endif
	            <li class="nav-item">
	              <a class="nav-link" href="{{route('review.index')}}">Review</a>
	            </li>
	            <li class="nav-item dropdown">
	              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	                Company
	              </a>
	              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	                <li><a class="dropdown-item" href="{{route('aboutus')}}">About Us</a></li>
	                <li><a class="dropdown-item" href="{{route('contactus')}}">Contact us</a></li>
	              </ul>


               
                <li class="nav-item">
                    @if($logged)
                    <i>Welcome {{$loggedName}}</i><br/><a class="btn btn-outline-dark" href="{{route('user.logout')}}">Logout</a>
                    @else
                    <a class="btn btn-outline-dark" href="{{route('user.login')}}">Login</a>
                    @endif
				</li>
	            </li>
	         
	        </div>
	      </div>
	    </div>
		
        <div class='container'>
          @yield('breadcrumb')
        </div>

        <div class="container">
            <div class="row">
            @yield('corpo')
               
        </div>
    </body>


</html>

@yield('script')

<script>
var lastScrollTop;
navbar = document.getElementById('mainNavigation');
window.addEventListener('scroll',function(){
var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
if(scrollTop > lastScrollTop){
navbar.style.top='-80px';
}
else{
navbar.style.top='0';
}
lastScrollTop = scrollTop;
});
</script>