<!doctype html>
<html lang="en">
  <head>
  	<title>Contenitore di evento per i ricercatori</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			 <div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">EventApp</h2>
				</div>
			</div> 

			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Acccedi al tuo conto per pubblicare e diffondere i tuoi eventi </h3>
		      	<form action="#" class="signin-form" id="signupForm">
		      		<div class="form-group">
		      			<input type="text" class="form-control" id="indirizzo_mail" placeholder="Indirizzo mail" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" id="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
				<button type="submit" class="form-control btn btn-primary submit px-3">Accesso</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Non dimenticare l'accesso
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Password dimenticata</a>
								</div>
	            </div>
	          </form>
			  <a href="../index"><button class="btn btn-success" style="float:left">Home page</button></a>

			  <a href="registrati"><button class="btn btn-success" style="float:right">Registrati</button></a>
	          <!--<p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
	          	<a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
	          </div> -->
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>
	document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("signupForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        const email = document.getElementById("indirizzo_mail").value.trim();
        const password = document.getElementById("password-field").value.trim();

        if (email === "" || password === "") {
            alert("Tutti i campi sono obbligatori !");
            return;
        }

        const response = await fetch("../api/utente", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                action: "login",
                indirizzo_mail: email,
                password: password,
            }),
        });

        const result = await response.json();

        if (result.success) {
            alert("Bravissimo ! Verrai reindirizzato verso il dashboard.");
            window.location.href = "../utente/"; 
        } else {
            alert("Errore : " + result.message);
        }
    });
});

</script>

	</body>
</html>

