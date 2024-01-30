<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/valid_review.css">
    <title>Valide commentaire</title>
</head>
<body>
    <main>
        <h1 class="titreReview">Valider les commentaires</h1>
                <?php
                    include 'bdd.php';
                    //affichage d'un commentaire utilisateur en attente de validation//
                    $sql = "SELECT * FROM reviewValid";
                    $result = $connect->query($sql);

                        if ($result && $result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<div class="form">';
                                echo '<div class="formContent">';
                                echo '<p class="label">Note: </p>';
                                echo '<p class="input">' . $row['note'] . '</p>';
                                echo '<p class="label">Nom: </p>';
                                echo '<p class="input">' . $row['name'] . '</p>';
                                echo '<p class="label">Date: </p>';
                                echo '<p class="input">' . $row['date'] . '</p>';
                                echo '<p class="label">Avis: </p>';
                                echo '<p class="inputAvis">' . $row['content'] . '</p>';
                                echo '<form action="valid_review.php" method="post">';
                                echo '<input type="hidden" name="id_reviewValid" value="' . $row['id_reviewValid'] . '">';
                                echo '<input class="submit" type="submit" name="valide" value="Valider">';
                                echo '</form>';
                                echo '<form action="valid_review.php" method="post">';
                                echo '<input type="hidden" name="id_reviewValid" value="' . $row['id_reviewValid'] . '">';
                                echo '<input class="submit" type="submit" name="delete" value="Supprimer">';
                                echo '</form>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "Aucun commentaire en attente de validation.";
                        }
                    ?>

            <?php
            //recupère en table reviewValid pour valider le post//
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valide'])) {
                $reviewId = $_POST['id_reviewValid'];

                $sqlSelect = "SELECT * FROM reviewValid WHERE id_reviewValid = :reviewId";
                $stmtSelect = $connect->prepare($sqlSelect);
                $stmtSelect->bindParam(':reviewId', $reviewId);
                $stmtSelect->execute();
                
                //enregistrement en table review si validé//
                if ($stmtSelect->rowCount() > 0) {
                    $row = $stmtSelect->fetch(PDO::FETCH_ASSOC);

                    $sqlInsert = "INSERT INTO review (note, name, date, content) VALUES (:note, :name, :date, :content)";
                    $stmtInsert = $connect->prepare($sqlInsert);
                    $stmtInsert->bindParam(':note', $row['note']);
                    $stmtInsert->bindParam(':name', $row['name']);
                    $stmtInsert->bindParam(':date', $row['date']);
                    $stmtInsert->bindParam(':content', $row['content']);
                    $stmtInsert->execute();

                    $sqlDelete = "DELETE FROM reviewValid WHERE id_reviewValid = :reviewId";
                    $stmtDelete = $connect->prepare($sqlDelete);
                    $stmtDelete->bindParam(':reviewId', $reviewId);
                    $stmtDelete->execute();

                    echo "<script>alert('Avis validé et enregistré avec succès.')</script>";
                } else {
                    echo "<script>alert('Aucune donnée à valider.')</script>";
                }
            }
        ?>
        <?php

                //suppression de la table reviewValid si refusé//
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
                    $reviewId = $_POST['id_reviewValid'];

                    $sqlDelete = "DELETE FROM reviewValid WHERE id_reviewValid = :reviewId";
                    $stmtDelete = $connect->prepare($sqlDelete);
                    $stmtDelete->bindParam(':reviewId', $reviewId);
                    $stmtDelete->execute();

                    echo "<script>alert('Avis supprimé avec succès.')</script>";
                } 
                

        ?>

        <aside>
            <form class="form" method="post" action="valid_review.php">
                <input label="label" type="hidden" name="logout" value="true">
                <button class="submitRetour" type="submit">Retour</button>
            </form>
        </aside>

        <?php
        //bouton retour//
        if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: /server/connection.php");
        exit();
        }
        ?>

    </main>
</body>
</html>