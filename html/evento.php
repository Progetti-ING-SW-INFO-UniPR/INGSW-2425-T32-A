
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
                                    <li class="nav-item">
                                        <a href="index" aria-label="Toggle navigation">HOME PAGE</a>
                                    </li>
                    
                                    <li class="nav-item">
                                        <a href="login/" aria-label="Toggle navigation">LOGIN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="login/registrati" aria-label="Toggle navigation">REGISTRATI</a>
                                    </li>
                                   
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

                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="hero-content">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="@hashtag..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button"> 
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
                                <h1 id="days">12</h1>
                                <h2 id="daystxt">Eventi disponibili</h2>
                            </div>
                            <div class="box">
                                <h1 id="hours">24</h1>
                                <h2 id="hourstxt">Eventi passati</h2>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Count Down Area -->

    <!-- Start Features Area -->
    <section class="features section" style="background-image: url(img/bg.jpg); background-attachment: fixed;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 style="color:white" class="wow zoomIn" data-wow-delay=".2s">Visualizza eventi</h3>
                      
                    </div>
                </div>
            </div>
            <div class="row" id="getEvent"></div>
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
        //========= glightbox
        GLightbox({
            'href': 'https://www.youtube.com/watch?v=Gxw45q3Ga3k',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });

        //========= testimonial 
        tns({
            container: '.testimonial-slider',
            items: 3,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            gutter: 0,
            nav: true,
            controls: false,
            controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 2,
                },
                1170: {
                    items: 3,
                }
            }
        });
    </script>
    <script>
        const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

        const timer = () => {
            const now = new Date().getTime();
            let diff = finaleDate - now;
            if (diff < 0) {
                document.querySelector('.alert').style.display = 'block';
                document.querySelector('.container').style.display = 'none';
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
            let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
            let seconds = Math.floor(diff % (1000 * 60) / 1000);

            days <= 99 ? days = `0${days}` : days;
            days <= 9 ? days = `00${days}` : days;
            hours <= 9 ? hours = `0${hours}` : hours;
            minutes <= 9 ? minutes = `0${minutes}` : minutes;
            seconds <= 9 ? seconds = `0${seconds}` : seconds;

            document.querySelector('#days').textContent = days;
            document.querySelector('#hours').textContent = hours;
            document.querySelector('#minutes').textContent = minutes;
            document.querySelector('#seconds').textContent = seconds;

        }
        timer();
        setInterval(timer, 1000);
    </script>

  <!--  <script>
        function getAllArticles() {
            fetch('api/index.php')  // 🔹 Appelle l'API en GET
                .then(response => response.json())  // Convertit la réponse en JSON
                .then(articles => {
                console.log("Données reçues:", articles);  // 🔍 Vérifie la réponse
                const liste = document.getElementById("event-list");
                liste.innerHTML = "";  // Efface l'affichage précédent

                articles.forEach(article => {
                    const item = document.createElement("li");
                    item.textContent = `${article.id_evento} - ${article.titolo}`;
                    liste.appendChild(item);
                });
                })
                .catch(error => console.error("Erreur:", error));
        }


        getAllArticles();  // 🔹 Appelle la fonction pour récupérer les articles
</script> -->

<script>
function getAllArticles() {
    fetch('api/')
        .then(response => response.json())
        .then(articles => {
            const container = document.getElementById("getEvent");
            container.innerHTML = ""; // Efface les anciens articles

            articles.forEach((article, index) => {
                const articleHTML = `
                    <div class="col-lg-4 col-md-6 col-6 wow" data-wow-delay=".${index + 2}s">
                        <!-- Start Single Feature -->
                        <div class="single-featuer">
                            <div class="action-box">
                                <img style="border-radius: 15px;" src="img/event1.jpg" alt="">
                            </div> <br>
                            <img class="shape" src="assets/images/features/shape.svg" alt="#">
                            <img class="shape2" src="assets/images/features/shape2.svg" alt="#">
                            <span class="serial">${index + 1}</span>
                            <h3>${article.titolo}</h3> 
                            <div class="btn btn-success">${article.data_creazione}</div> <br> <br>
                            <p>${article.descrizione}</p> <br>
                            <div class="service-icon">
                                <i class="lni lni-heart"></i> 
                            </div>
                            <div style="float:right" class="btn btn-primary">Iscriversi</div>
                        </div>
                        <!-- End Single Feature -->
                    </div>
                `;

                // Ajouter le HTML généré dans le container
                container.innerHTML += articleHTML;
            });
        })
        .catch(error => console.error("Erreur:", error));
}
    getAllArticles();

   setInterval(getAllArticles, 1000);
</script>

</body>

</html>