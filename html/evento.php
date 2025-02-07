<?php session_start(); ?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<?php include "inc/head.php"; ?>

<body >
   
    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="assets/images/logo/logo.svg" alt="Logo">
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
                            </div> <!-- navbar collapse -
                            <div class="button">
                                <a href="login/" class="btn">Accesso<i class="lni lni-user"></i></a>
                            </div>
                            <div class="button">
                                <a href="login/registrati.php" class="btn">Registrati<i class="lni lni-user"></i></a>
                            </div>
                        </nav>
                                End Navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    <!-- End Header Area -->

    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="main__circle"></div>
        <div class="main__circle2"></div>
        <div class="main__circle3"></div>
        <div class="main__circle4"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <div class="hero-content">

                        <!--<div class="button wow fadeInUp" data-wow-delay=".8s">
                            <a href="pricing.html" class="btn ">Hashtag @</a>
                        </div>  -->
                        <?php if(isset($_SESSION["id_account"])):?>
                        <div class="button">
                                <a href="utente/" class="btn"><i class="lni lni-user"></i> Utente : <?= htmlspecialchars($_SESSION["nome_utente"]); ?></a>
                            </div> <br>
                         <?php endif; ?>
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="hero-content">
                            <div class="input-group search-bar">
                                <input type="text" class="form-control" placeholder="@hashtag..." aria-label="Search">
                                <button class="btn btn-primary search-btn" type="button">
                                    <i class="lni lni-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Count Down Area -->
    <div class="count-down">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="box-head">
                        <div class="box-content">
                            <div class="box">
                                <h2 id="daystxt">Eventi disponibili</h2>
                            </div>
                            <div class="box">
                                <h1 id="hours">24</h1>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Count Down Area -->

    <!-- Start Features Area -->
    <section class="features section" >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Visualizza eventi</h3>
                      
                    </div>
                </div>
            </div>
            <div class="row" id="getEvent"></div>
                            <div id="event-detail-container" style="display: none;">
                                 <div class="event-detail">
                            <img id="event-detail-image" src="" alt="Event Image">
                        <h2 id="event-detail-title"></h2>
                        <div class="btn btn-success" id="event-detail-date"></div>
                        <p id="event-detail-description"></p>
                        <button class="btn btn-primary">S'inscrire</button>
                        <button class="btn btn-danger" id="btn-retour">Fermer</button>
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
function getAllArticles() {
    fetch('api/evento')
        .then(response => response.json())
        .then(articles => {
            const container = document.getElementById("getEvent");
            container.innerHTML = ""; // Efface les anciens articles

            articles.forEach(article => {
                const articleHTML = `
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="event-card">
                            <div class="event-image">
                                <img src="img/${article.immagine}" alt="${article.titolo}">
                            </div>
                            <div class="event-body">
                                <h3 class="event-title">${article.titolo}</h3>
                                <div class="event-meta">
                                    <span><i class="lni lni-user"></i> ${article.autore}</span>
                                    <span><i class="lni lni-map-marker"></i> ${article.luogo_svolgimento}</span>
                                    <span><i class="lni lni-calendar"></i> ${article.data_svolgimento}</span>
                                    <span class="event-hashtag">#${article.hashtag}</span>
                                </div>
                                <p class="event-description">${article.descrizione.substring(0, 100)}...</p>
                                <div class="event-footer">
                                    <button class="btn btn-primary btn-iscriversi" data-id="${article.id_evento}">S'inscrire</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += articleHTML;
            });
        })
        .catch(error => console.error("Erreur:", error));
}

    getAllArticles();

   setInterval(getAllArticles, 5000);

   // Fonction pour afficher les détails de l'événement
        function showEventDetails(eventId) {
            fetch(`/api/evento/${eventId}`) // Récupère les détails de l'événement via l'API
                .then(response => response.json())
                .then(data => {
                
                    if (Array.isArray(data) && data.length > 0) {
                        let event = data[0];  // On prend le premier élément du tableau
                        console.log(event);

                        document.getElementById("event-detail-title").textContent = event.titolo ?? "";
                        document.getElementById("luogo").textContent = event.luogo_svolgimento ?? "";
                        document.getElementById("event-detail-date").textContent = event.data_svolgimento ?? "";
                        document.getElementById("event-detail-description").textContent = event.descrizione ?? "";
                        document.getElementById("event-detail-image").src = "img/"+event.image || img/event1.jpg;
                } else {
                    console.error("Erreur : L'API ne retourne pas de données valides");
                    alert("Aucun événement trouvé !");
                    window.location.href = "index";
                }
                  
                    // Affiche la section des détails
                    document.getElementById("event-detail-container").style.display = "block";
                })
                .catch(error => console.error("Erreur:", error));
        }

            // Ajoute un événement "click" sur tous les boutons "Iscriversi"
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("btn-iscriversi")) {
                let eventId = event.target.getAttribute("data-id");
                showEventDetails(eventId);
                document.getElementById("getEvent").style.display="none";
            }
        });

        document.getElementById("btn-retour").addEventListener("click", function () {
            document.getElementById("event-detail-container").style.display = "none"; // Cache les détails
            document.getElementById("getEvent").style.display = "block"; // Réaffiche la liste des articles
        });


</script>

</body>

</html>