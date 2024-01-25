<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/service.css">
    <title>Services</title>
</head>
<body>
    <main>
        <h1 class="serviceTitre">Services</h1>
        <form class="formContent" action="service.php" method="post">
            <label class="label" for="service">Service :</label>
            <input class="input" type="text" name="service" id="service" placeholder="Type de prestation" required>
            <label class="label" for="description">Description :</label>
            <textarea class="inputDescription" name="message" id="message" cols="30" rows="10" placeholder="Description de la prestation" required></textarea>
            <button class="submit" type="submit">Ajouter</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST['service']) && isset($_POST['description'])) {
                $service = $_POST['service'];
                $description = $_POST['description'];
                
                $sql_insert_service = ('INSERT INTO service (category, description) VALUES (:service, :description)');
                $sql_insert_service = $connect->prepare($sql_insert_service);
                $sql_insert_service->bindParam(':service', $service);
                $sql_insert_service->bindParam(':description', $description);
                if ($stmt_insert_service->execute()) {
                    echo '<script>alert("Prestation ajouté avec succès!");</script>';
                } else {
                    echo '<script>alert("Erreur lors de l\'ajout!");</script>';
                }
            }
        }
        ?>
    </main>
</body>
</html>