<?php session_start();?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<?php include "inc/head.php"; ?>

<body>

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="evento">
                                <img src="assets/images/logo/logo.png" alt="Logo">
                            </a>
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <?php if(isset($_SESSION['id_account'])): ?>
                                        <li class="nav-item">
                                            <a href="utente/" aria-label="Toggle navigation">DASHBOARD</a>
                                        </li>
                                            <div class="user-notification">
                                                <span class="user-text">👋 <?= htmlspecialchars($_SESSION['nome_utente']); ?> è connesso</span>
                                                <button class="btn-green">✓</button>
                                            </div>
                                    <?php else : ?>
                                        <li class="nav-item">
                                            <a href="index" aria-label="Toggle navigation">HOME PAGE</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="login/" aria-label="Toggle navigation">LOGIN</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="login/registrati" aria-label="Toggle navigation">REGISTRATI</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div> 
                            
                        </nav>
                    </div>
                </div>
            </div> 
        </div> 
    </header>
    <!-- End Header Area -->
    

    <!-- Start Features Area -->
    <section class="features section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Iscrizione </h3>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <div class="event-card">
                        <div class="event-image">
                                        <img style=" width: 70%;          /* Prendre toute la largeur de son conteneur sans être coupée */
                height: auto;         /* Garder les proportions de l'image */
                object-fit: contain;  /* Adapter l'image à l'espace disponible sans la déformer */
                max-width: 70%;      /* Ne pas dépasser la largeur du conteneur */
                display: block;
                margin: 0 auto;      " id="immagine" src="" alt="Immagine dell'evento">
                        </div>
                        <div class="event-body">
                            <h3 id="titolo" class="event-title"></h3>
                            <div class="event-meta">
                                <span><i class="lni lni-user"></i> <span id="nome_utente"></span></span>
                                <span><i class="lni lni-map-marker"></i> <span id="luogo"></span></span>
                                <span><i class="lni lni-calendar"></i> <span id="data"></span></span>
                                <span class="event-hashtag" id="hashtag"></span>
                            </div>
                            <p id="descrizione" class="event-description"></p>
                                            

                         <div class="event-buttons">
                            <?php if (isset($_SESSION['id_account'])): ?>
                                <!-- Bouton pour les utilisateurs connectés -->
                                <a href="evento"><button class="btn-cancel">Annulla</button></a>
                                <button class="btn-register" id="btn-register">Iscriviti</button>
                            <?php else: ?>
                                <a href="evento"><button class="btn-cancel">Annulla</button></a>
                                <button class="btn-iscriversi" id="btn-iscriversi">Iscriviti</button>
                            <?php endif; ?>
                        </div>

                        
                            <!-- Fenêtre modale -->
                        <div id="modal-inscription" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Come vuole iscriversi all'evento ?</h2>
                                <div class="modal-buttons">
                                    <button id="btn-login" class="btn-option">Ricercatore/Altri enti</button>
                                    <button id="btn-form" class="btn-option">Utente esterno</button>
                                </div>
                                <form id="form-inscription" class="hidden">
                                    <input type="text" id="nom" name="nom" placeholder="Nome" required>
                                    <input type="email" id="email" name="email" placeholder="Indirizzo mail" required>
                                    <button type="submit" class="btn-submit">Iscriviti</button>
                                </form>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Features Area -->



    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get("action");
    const eventId = urlParams.get("id");
    const userId = <?php echo isset($_SESSION['id_account']) ? $_SESSION['id_account'] : 'null'; ?>;

    if (action === "view" && eventId && userId) {
        fetch("../api/backend?action=rimozione_notifica", {
            method: "DELETE",
            body: JSON.stringify({ action: "marcare_letto", id_account: userId, id_evento: eventId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Notification marquée comme lue !");
            } else {
                console.error("Erreur: " + data.message);
            }
        })
        .catch(error => console.error("Erreur:", error));
    }
});

    </script>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get("id");

        if (!eventId) {
            alert("Nessun evento trovato !");
            window.location.href = "evento";
        } else {
            fetch(`api/evento/${eventId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data || data.success === false) {
                        alert("Evento non trovato !");
                        window.location.href = "evento";
                        return;
                    }

                    let event = data[0];

                    console.log(event);

                    document.getElementById("titolo").textContent = event.titolo ?? "Senza titolo";
                    document.getElementById("immagine").src = event.immagine ? `img/${event.immagine}` : "img/default.jpg";
                    document.getElementById("nome_utente").textContent = event.nome_utente ?? "Anonimo";
                    document.getElementById("data").textContent = event.data_svolgimento ?? "Data sconosciuta";
                    document.getElementById("luogo").textContent = event.luogo_svolgimento ?? "Luogo sconosciuto";
                    document.getElementById("hashtag").textContent = "#" + (event.hashtag ?? "Senza hashtag");
                    document.getElementById("descrizione").innerHTML = event.descrizione;

                    document.querySelector(".btn-iscriversi").setAttribute("data-id", event.id_evento);
                })
                .catch(error => console.error("Erreur:", error));
        }

        </script>

        <script>


        document.addEventListener("DOMContentLoaded", function () {
            const eventId = new URLSearchParams(window.location.search).get("id"); // ID de l'événement

            const modal = document.getElementById("modal-inscription");
            const closeModal = document.querySelector(".close");
            const btnLogin = document.getElementById("btn-login");
            const btnForm = document.getElementById("btn-form");
            const formInscription = document.getElementById("form-inscription");

            document.querySelector(".btn-iscriversi").addEventListener("click", function () {
                modal.style.display = "flex";
            });

            closeModal.addEventListener("click", function () {
                modal.style.display = "none";
            });

            btnLogin.addEventListener("click", function () {
                window.location.href = "../login/index?id=<?= $_GET['id'];?>";
            });

            btnForm.addEventListener("click", function () {
                formInscription.classList.remove("hidden");
                btnForm.style.display = "none";
                btnLogin.style.display = "none";
            });

            formInscription.addEventListener("submit", function (e) {
                e.preventDefault();

                const nom = document.getElementById("nom").value;
                const email = document.getElementById("email").value;

                fetch("../api/iscrizione", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ action:"iscrizione_utente_esterno", nome_utente: nom, indirizzo_mail: email, evento: eventId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("L'iscrizione è avvenuta con successo !");
                        modal.style.display = "none";
                        formInscription.reset();
                        window.location.href="evento";
                    } else {
                        alert("Errore: " + data.message);
                    }
                })
                .catch(error => console.error("Errore:", error));
            });
        });

        </script>

        <script>
        document.querySelector('.btn-register').addEventListener('click', function() {

            const userId = <?php echo $_SESSION['id_account']; ?>; 
            console.log(eventId);

            if (userId && eventId) {
                fetch('../api/iscrizione', {
                    method: 'POST',
                    body: JSON.stringify({action: "iscrizione", id_account: userId, id_evento: eventId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href="evento";
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('Errore nella richiesta: ' + error);
                });
            } else {
                alert('Errore: ID evento o ID utente non validi.');
            }
        });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const closeButton = document.querySelector(".btn-green");
        if (closeButton) {
            closeButton.addEventListener("click", function () {
                document.querySelector(".user-notification").style.display = "none";
            });
        }
    });
</script>


</body>

</html>
