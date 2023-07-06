<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Autenticazione utente</title>
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
        <h1>Crea un account</h1>
			<span>Inserisci i dati richiesti</span>
                                <div class="form-group">
                                <input  type="text" name="name" class="form-control" placeholder="Nome" value="" maxlength="30"/>
                                 @error('name')
                                        <div id="registration_error"  class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                 </div>

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="" maxlength="30"/>
                                    @error('email')
                                     <div id="registration_error"  class="alert alert-danger" role="alert">{{$message}}</div>
                                     @enderror
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="" maxlength="30"/>
                                    @error('password')
                                      <div id="registration_error"  class="alert alert-danger" role="alert">{{$message}}</div>
                                      @enderror
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="confirm-password" class="form-control" placeholder="Conferma password" value="" maxlength="30"/>
                                    @error('confirm-password')
                                      <div id="registration_error"  class="alert alert-danger" role="alert">{{$message}}</div>
                                      @enderror
                                </div>

                                <div class="container">
                                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Indietro</a>
                                <label for="Register" class="btn btn-primary"><i class="bi-check-lg"></i> Registrati</label>
                                <input id="Register" type="submit" value="Register" class="hidden"/>
                                </div>
                            </form>
	</div>
	<div class="form-container sign-in-container">
            <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 2em">
            <h1>Accedi</h1>
			<span>Inserisci la tua email e la password con i quali ti sei registrato</span>   
            @csrf
                                <div class="form-group">
                                    <input type="text" name="l_email" class="form-control" placeholder="Email" maxlength="30"/>
                                    @error('l_email')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" name="l_password" class="form-control" placeholder="Password" maxlength="30"/>
                                    @error('l_password')
                                  <div class="alert alert-danger" role="alert">{{$message}}</div>
                                 @enderror
                                </div>

                                <div class="container">
                                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Indietro</a>
                                <label for="Login" class="btn btn-primary"><i class="bi-check-lg"></i> Login</label>
                                <input id="Login" type="submit" value="Login" class="hidden"/>
                                </div>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Bentornato!</h1>
				<p>Per conneterti con noi accedi con le tue credenziali personali</p>
				<button class="ghost" id="signIn">Accedi</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Ciao Amico!</h1>
				<p>Inserisci i tuoi dati personali per accedere al canile!</p>
				<button class="ghost" id="signUp">Registrati</button>
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
