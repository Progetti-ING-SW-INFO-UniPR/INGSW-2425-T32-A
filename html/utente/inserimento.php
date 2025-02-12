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
            <input type="file" class="form-control" id="image" accept="image/*">
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
    document.getElementById("articleForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

     // Mettre à jour la valeur du textarea avec le contenu de TinyMCE
     tinymce.triggerSave(); 

    let formData = new FormData();
    formData.append("title", document.getElementById("titolo").value);
    formData.append("luogo", document.getElementById("luogo").value);
    formData.append("hashtag", document.getElementById("hashtag").value);
    formData.append("datetime", document.getElementById("datetime").value);
    formData.append("descrizione", document.getElementById("descrizione").value);
    formData.append("hashtag", document.getElementById("hashtag").value);

    
    let imageInput = document.getElementById("image");
    if (imageInput.files.length > 0) {
        formData.append("image", imageInput.files[0]); 
    }

    fetch("../api/evento", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("L'evento è stato aggiunto con successo !");
            document.getElementById("articleForm").reset();
        } else {
            alert("Erreur : " + data.message);
        }
    })
    .catch(error => console.error("Erreur:", error));
});

</script>




</body>

</html>