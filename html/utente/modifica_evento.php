<?php 
    require "inc/sessione.php";
    attivazione_sessione("nome_utente")
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contenitore di evento per i ricercatori</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include "inc/menu.php"; ?>

                <!-- Begin Page Content 
                <div class="container-fluid">

                   <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="img/undraw_posting_photo.svg" alt="...">
                        </div>
                        <p>Add some quality, svg illustrations to your project courtesy of <a
                                target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                            constantly updated collection of beautiful svg images that you can use
                            completely free and without attribution!</p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                            unDraw &rarr;</a>
                    </div>
                </div> -->


<div class="form-container">
    <h3 class="text-center mb-4">Inserire un evento</h3>
    <form id="articleForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titre" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="titolo" placeholder="Inserire il titolo" required>
        </div>
        <div class="mb-3">
            <label for="titre" class="form-label">Luogo</label>
            <input type="text" class="form-control" id="luogo" placeholder="Inserire il luogo" required>
        </div>
        <div class="mb-3">
    <label for="datetime" class="form-label">Data e ora</label>
    <input type="text" class="form-control" id="datetime" placeholder="Selezionare la data e l'ora">
</div>

<div class="mb-3">
            <label for="titre" class="form-label">Hashtag</label>
            <input type="text" class="form-control" id="hashtag" placeholder="Inserire l'hashtag corrispondente all'evento" required>
        </div>

        <div class="mb-3">
    <label for="description" class="form-label">Descrizione</label>
    <textarea class="form-control" id="descrizione" rows="4" placeholder="Inserire la descrizione"></textarea>
</div>

        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" class="form-control" id="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Publiccare</button>
    </form>
</div>
                   
                    

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <?php require "inc/logout_mod.php"; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.1/tinymce.min.js"></script>
    <script>
    tinymce.init({
        selector: '#descrizione',
        menubar: false,
        plugins: 'advlist autolink lists link charmap print preview anchor',
        toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        branding: false
    });
</script>

<script>
    flatpickr("#datetime", {
        enableTime: true,
        dateFormat: "d-m-y H:i",
        time_24hr: true,
        locale: "fr"
    });
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const eventId = urlParams.get("id");

    if (!eventId) {
        alert("Aucun événement sélectionné !");
        window.location.href = "index.html";
        return;
    }

    // Récupérer les données de l'événement
    fetch(`../api/evento/${eventId}`)
        .then(response => response.json())
        .then(data => {
            console.log("Données reçues :", data);

         if (Array.isArray(data) && data.length > 0) {
            let event = data[0];  // On prend le premier élément du tableau
            
            document.getElementById("titolo").value = event.titolo ?? "";
            document.getElementById("luogo").value = event.luogo_svolgimento ?? "";
            document.getElementById("datetime").value = event.data_svolgimento ?? "";
            document.getElementById("descrizione").value = event.descrizione ?? "";
            tinymce.get("descrizione").setContent(event.descrizione ?? "");
        } else {
            console.error("Erreur : L'API ne retourne pas de données valides");
            alert("Aucun événement trouvé !");
            window.location.href = "index";
        }

        })
        .catch(error => console.error("Erreur de chargement :", error));

    // Gérer la mise à jour
    document.getElementById("articleForm").addEventListener("submit", function (event) {
        event.preventDefault();

        const updatedData = {
            titolo: document.getElementById("titolo").value,
            luogo_svolgimento: document.getElementById("luogo").value,
            data_svolgimento: document.getElementById("datetime").value,
            hashtag: document.getElementById("hashtag").value,
            descrizione: tinymce.get("descrizione").getContent()
        };

        fetch(`../api/evento/${eventId}`, {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(updatedData)
        })
        .then(response => response.json())
        .then(data => {
            alert("Événement mis à jour avec succès !");
            window.location.href = "index.html";
        })
        .catch(error => console.error("Erreur de mise à jour :", error));
    });
});

</script>



</body>

</html>