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
	<body  style="background-image: url(images/bg.jpg); background-attachment: fixed;">
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
		      	<h3 class="mb-4 text-center">Crea il tuo conto per iniziare a pubblicare e diffondere i tuoi eventi </h3>
								<form action="#" class="signin-form" id="signupForm">
					<div class="form-group">
						<input type="text" class="form-control" id="nome_utente" placeholder="Nome utente" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="indirizzo_mail" placeholder="Inserire l'indirizzo mail" required>
					</div>
					<div class="form-group">
						<input id="password" type="password" class="form-control" placeholder="Inserire la password" required>
						<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					</div>
					<div class="form-group">
						<input id="password_confirm" type="password" class="form-control" placeholder="Ripetere la password" required>
						<span toggle="#password_confirm" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					</div>
					<div class="form-group">
						<label for="options">Tipologia di utente: </label>
						<select id="tipologia" name="options">
							<option value="option1">Ricercatore</option>
							<option value="option2">Altri enti</option>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="form-control btn btn-primary submit px-3">Registrati</button>
					</div>
				</form>

              <a href="../index.php"><button class="btn btn-success" style="float:left">Home page</button></a>

			<a href="index"><button class="btn btn-success" style="float:right">Accedere</button></a>  
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
    document.getElementById("signupForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche l'envoi du formulaire

        let nomeUtente = document.getElementById("nome_utente").value.trim();
        let email = document.getElementById("indirizzo_mail").value.trim();
        let password = document.getElementById("password").value.trim();
        let confirmPassword = document.getElementById("password_confirm").value.trim();
        let errors = [];

        
        if (nomeUtente === "") {
            errors.push("Il nome utente deve essere inserito.");
        }

       
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            errors.push("L'indirizzo mail non è valido.");
        }

       
        if (password.length < 6) {
            errors.push("La password deve contenere almene 6 caratteri.");
        }

      
        if (password !== confirmPassword) {
            errors.push("Le password non corrispondono.");
        }

       
        if (errors.length > 0) {
            alert(errors.join("\n")); 
        } else {
            alert("Complimenti ! La registrazione è andata bene");
			
			const username = document.getElementById("nome_utente").value;
            const email = document.getElementById("indirizzo_mail").value;
            const password = document.getElementById("password").value;
			const typ=document.getElementById("password").value;

			console.log(username);

            fetch("../api/utente", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    action: "register",
                    nome_utente: username,
                    indirizzo_mail: email,
                    password: password,
					tipologia:typ
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message || data.error);
            })
            .catch(error => console.error("Errore:", error));
			

              setTimeout(() => {
                  window.location.href = "index";
               }, 3000);
        }
    });


    // Fonction pour afficher/masquer le mot de passe
    document.querySelectorAll(".toggle-password").forEach(function (toggle) {
        toggle.addEventListener("click", function () {
            let passwordField = document.querySelector(toggle.getAttribute("toggle"));
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggle.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggle.classList.remove("fa-eye-slash");
            }
        });
    });
});
</script>



	</body>
</html>

