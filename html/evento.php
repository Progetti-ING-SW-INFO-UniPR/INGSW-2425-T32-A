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
                         <form id="searchForm" class="d-flex align-items-center">
                            <input type="text" id="searchInput" class="form-control me-2" placeholder="#hashtag..." aria-label="Search">
                            <button class="btn btn-primary" type="submit">
                                <i class="lni lni-search"></i>
                            </button>
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
                                <h1 id="hours"></h1>
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
    let isSearching = false; 

    function getAllArticles() {
        if (isSearching) return; 

        fetch('api/evento')
            .then(response => response.json())
            .then(articles => {
                const container = document.getElementById("getEvent");
                container.innerHTML = ""; 

                let numero = articles[0];
                document.getElementById("hours").textContent = numero.totale;

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
                                        <span><i class="lni lni-user"></i> ${article.nome_utente} | ${article.tipologia} </span>
                                        <span><i class="lni lni-map-marker"></i> ${article.luogo_svolgimento}</span>
                                        <span><i class="lni lni-calendar"></i> ${article.data_svolgimento}</span>
                                        <span class="event-hashtag">#${article.hashtag}</span>
                                    </div>
                                    <p class="event-description">${article.descrizione.substring(0, 100)}...</p>
                                    <div class="event-footer">
                                    <a href="show_evento?id=${article.id_evento}">
                                        <button class="btn btn-primary btn-iscriversi" data-id="${article.id_evento}"> Iscriversi</button>
                                    </a>
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

document.getElementById("searchForm").addEventListener("submit", function (e) {
    e.preventDefault(); 

    let hashtag = document.getElementById("searchInput").value.trim();

    if (hashtag === "") {
        alert("Deve inserire una parola !");
        isSearching = false; 
        getAllArticles();
        return;
    }

    isSearching = true; 

    fetch(`api/hashtag/${encodeURIComponent(hashtag)}`)
        .then(response => response.json())
        .then(events => {
            console.log(events);
            const container = document.getElementById("getEvent");
            container.innerHTML = ""; 

            if (events.length === 0) {
                container.innerHTML = "<p>Nessun elemento trovato.</p>";
                return;
            }

            events.forEach(event => {
                const eventHTML = `
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="event-card">
                            <div class="event-image">
                                <img src="img/${event.immagine}" alt="${event.titolo}">
                            </div>
                            <div class="event-body">
                                <h3 class="event-title">${event.titolo}</h3>
                                <div class="event-meta">
                                    <span><i class="lni lni-user"></i> ${event.nome_utente} | ${event.tipologia} </span>
                                    <span><i class="lni lni-map-marker"></i> ${event.luogo_svolgimento}</span>
                                    <span><i class="lni lni-calendar"></i> ${event.data_svolgimento}</span>
                                    <span class="event-hashtag">#${event.hashtag}</span>
                                </div>
                                <p class="event-description">${event.descrizione.substring(0, 100)}...</p>
                                <div class="event-footer">
                                   <a href="show_evento?id=${event.id_evento}">
                                       <button class="btn btn-primary btn-iscriversi" data-id="${event.id_evento}"> Iscriversi</button>
                                   </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += eventHTML;
            });
        })
        .catch(error => console.error("Erreur:", error));
});

document.getElementById("searchInput").addEventListener("input", function () {
    if (this.value.trim() === "") {
        isSearching = false;
        getAllArticles();
    }
});
</script>


</body>

</html>