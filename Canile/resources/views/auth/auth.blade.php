<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User authentication</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
        <!-- Icone Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- jQuery e plugin JavaScript -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>

    <div class="container containerAuth" id="containerAuth">
	<div class="form-container sign-up-container">
    <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 2em">
        @csrf
        <h1>Create account</h1>
			<span>Use your email for registration</span>
                                <div class="form-group">
                                <input  type="text" name="name" class="form-control" placeholder="Name" value=""/>
                                 @error('name')
                                        <div id="registration_error"  class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                 </div>

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email" value=""/>
                                    @error('email')
                                     <div id="registration_error"  class="alert alert-danger" role="alert">{{$message}}</div>
                                     @enderror
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="password" class="form-control" placeholder="Password" value=""/>
                                    @error('password')
                                      <div id="registration_error"  class="alert alert-danger" role="alert">{{$message}}</div>
                                      @enderror
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="confirm-password" class="form-control" placeholder="Confirm password" value=""/>
                                    @error('confirm-password')
                                      <div id="registration_error"  class="alert alert-danger" role="alert">{{$message}}</div>
                                      @enderror
                                </div>

                                <div class="container">
                                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Register" class="btn btn-primary"><i class="bi-check-lg"></i> Register</label>
                                <input id="Register" type="submit" value="Register" class="hidden"/>
                                </div>
                            </form>
	</div>
	<div class="form-container sign-in-container">
            <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 2em">
            <h1>Sign-in</h1>
			<span>Use your email for sign-in</span>   
            @csrf
                                <div class="form-group">
                                    <input type="text" name="l_email" class="form-control" placeholder="e-Mail"/>
                                    @error('l_email')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" name="l_password" class="form-control" placeholder="Password"/>
                                    @error('l_password')
                                  <div class="alert alert-danger" role="alert">{{$message}}</div>
                                 @enderror
                                </div>

                                <div class="container">
                                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Login" class="btn btn-primary"><i class="bi-check-lg"></i> Login</label>
                                <input id="Login" type="submit" value="Login" class="hidden"/>
                                </div>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost authBotton" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost authBotton" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

</body>

</html>


<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('containerAuth');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

// per rimanere sulla parte di registrazione se c'è un errore in registrazione
var errorMessage = document.getElementById("registration_error").textContent;
if(errorMessage){
    container.classList.add("right-panel-active");
}
</script>
