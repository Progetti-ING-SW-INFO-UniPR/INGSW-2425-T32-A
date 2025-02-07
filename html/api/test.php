<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier un événement</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Modifier un événement</h3>
        <form id="editEventForm">
            <input type="hidden" id="eventId">
            
            <div class="mb-3">
                <label for="titolo" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titolo" required>
            </div>

            <div class="mb-3">
                <label for="luogo" class="form-label">Lieu</label>
                <input type="text" class="form-control" id="luogo" required>
            </div>

            <div class="mb-3">
                <label for="datetime" class="form-label">Date et Heure</label>
                <input type="text" class="form-control" id="datetime" required>
            </div>

            <div class="mb-3">
                <label for="descrizione" class="form-label">Description</label>
                <textarea class="form-control" id="descrizione" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>
</body>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const eventId = urlParams.get("id");

    if (!eventId) {
        alert("Aucun événement sélectionné !");
        window.location.href = "index.html";
        return;
    }

    const eventIdField = document.getElementById("eventId");
    eventIdField.value = eventId; 
    
    fetch(`evento/${eventId}`)
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
            let event = data[0];  // On prend le premier élément du tableau
            
            document.getElementById("titolo").value = event.titolo ?? "";
            document.getElementById("luogo").value = event.luogo_svolgimento ?? "";
            document.getElementById("datetime").value = event.data_svolgimento ?? "";
            document.getElementById("descrizione").value = event.descrizione ?? "";
        } else {
            console.error("Erreur : L'API ne retourne pas de données valides");
            alert("Aucun événement trouvé !");
            window.location.href = "index.html";
        }
        })
        .catch(error => console.error("Erreur de chargement :", error));

    document.getElementById("editEventForm").addEventListener("submit", function (event) {
        event.preventDefault();

        const updatedData = {
            titolo: document.getElementById("titolo").value,
            luogo_svolgimento: document.getElementById("luogo").value,
            data_svolgimento: document.getElementById("datetime").value,
            descrizione: document.getElementById("descrizione").value
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

</html>
