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
        <h1 class="serviceTitre">Ajouter un service</h1>
        <form class="formContent" action="service.php" method="post">
            <label class="label" for="service">Service :</label>
            <input class="input" type="text" name="service" id="service" placeholder="Type de prestation" required>
            <label class="label" for="description">Description :</label>
            <textarea class="inputDescription" name="description" id="description" cols="30" rows="10" placeholder="Description de la prestation" required></textarea>
            <button class="submit" type="submit">Ajouter</button>
        </form>
        <?php
        include('bdd.php');
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST['service']) && isset($_POST['description'])) {
                $category = $_POST['service'];
                $description = $_POST['description'];
                
                $sql_insert_service = ('INSERT INTO service (category, description) VALUES (:service, :description)');
                $stmt_insert_service = $connect->prepare($sql_insert_service);
                $stmt_insert_service->bindParam(':service', $category);
                $stmt_insert_service->bindParam(':description', $description);
                if ($stmt_insert_service->execute()) {
                    echo '<script>alert("Prestation ajouté avec succès!");</script>';
                } else {
                    echo '<script>alert("Erreur lors de l\'ajout!");</script>';
                }
            }
        }
        ?>
        <h1 class="serviceTitre">Supprimer un service</h1>
        <form class="formContent" action="service.php" method="post">
            <label class="label" for="serviceDelete">Service :</label>
            <input class="input" type="text" name="serviceDelete" id="serviceDelete" placeholder="Type de prestation" required>
            <button class="submit" type="submitDelete">Supprimer</button>
        </form>

        <?php
        if (isset($_POST['submitDelete'])) {
            $deleteService = $_POST['serviceDelete'];

            $sql_delete_service = ("DELETE FROM service WHERE category = :serviceDelete");
            $stmt_delete_service = $connect->prepare($sql_delete_service);
            $stmt_delete_service->bindParam(':serviceDelete', $deleteService, PDO::PARAM_STR);

            if ($stmt_delete_service->execute()) {
                echo '<script>alert("Service supprimé avec succès!");</script>';
            } else {
                echo '<script>alert("Erreur lors de la suppression");</script>';
            }
        }
    ?>

        <aside>
            <form class="form" method="post" action="service.php">
                <input label="label" type="hidden" name="logout" value="true">
                <button class="submitRetour" type="submit">Retour</button>
            </form>
        </aside>

    <?php
        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: /server/connection.php");
            exit();
        }
    ?>
    </main>
</body>
</html>