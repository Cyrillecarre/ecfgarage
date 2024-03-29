<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/schedule.css">
    <title>Horaires</title>
</head>
<body class="body">
    <h1 class="scheduleTitre">Modification des horaires du garage</h1>
    <div class="form">
        <form class="formContent" method="post" action="schedule.php">
            <label class="label" for="lundi_matin">Lundi matin :</label>
            <input type="time" name="hours_ouverture_lundi_matin">
            <input type="time" name="hours_fermeture_lundi_midi">
            <label class="label" for="lundi_apres">Lundi après-midi :</label>
            <input type="time" name="hours_ouverture_lundi_apres">
            <input type="time" name="hours_fermeture_lundi_soir">
            <label class="label" for="mardi_matin">Mardi matin :</label>
            <input type="time" name="hours_ouverture_mardi_matin">
            <input type="time" name="hours_fermeture_mardi_midi">
            <label class="label" for="mardi_apres">Mardi après-midi :</label>
            <input type="time" name="hours_ouverture_mardi_apres">
            <input type="time" name="hours_fermeture_mardi_soir">
            <label class="label" for="mercredi_matin">Mercredi matin:</label>
            <input type="time" name="hours_ouverture_mercredi_matin">
            <input type="time" name="hours_fermeture_mercredi_midi">
            <label class="label" for="mercredi_apres">Mercredi après-midi :</label>
            <input type="time" name="hours_ouverture_mercredi_apres">
            <input type="time" name="hours_fermeture_mercredi_soir">
            <label class="label" for="jeudi_matin">Jeudi matin :</label>
            <input type="time" name="hours_ouverture_jeudi_matin">
            <input type="time" name="hours_fermeture_jeudi_midi">
            <label class="label" for="jeudi_apres">Jeudi après-midi :</label>
            <input type="time" name="hours_ouverture_jeudi_apres">
            <input type="time" name="hours_fermeture_jeudi_soir">
            <label class="label" for="vendredi_matin">Vendredi matin :</label>
            <input type="time" name="hours_ouverture_vendredi_matin">
            <input type="time" name="hours_fermeture_vendredi_midi">
            <label class="label" for="vendredi_apres">Vendredi après-midi :</label>
            <input type="time" name="hours_ouverture_vendredi_apres">
            <input type="time" name="hours_fermeture_vendredi_soir">
            <label class="label" for="samedi_matin">Samedi matin :</label>
            <input type="time" name="hours_ouverture_samedi_matin">
            <input type="time" name="hours_fermeture_samedi_midi">
            <input class="submit" type="submit" name="submit" value="Modifier les horaires">
        </form>
        <aside>
            <form class="form" method="post" action="schedule.php">
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
        <?php
        include('bdd.php');
        //ajout des horaires en table schedule//
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST['hours_ouverture_lundi_matin']) && isset($_POST['hours_fermeture_lundi_midi'])
                && isset($_POST['hours_ouverture_lundi_apres']) && isset($_POST['hours_fermeture_lundi_soir']) 
                && isset($_POST['hours_ouverture_mardi_matin']) && isset($_POST['hours_fermeture_mardi_midi'])
                && isset($_POST['hours_ouverture_mardi_apres']) && isset($_POST['hours_fermeture_mardi_soir']) 
                && isset($_POST['hours_ouverture_mercredi_matin']) && isset($_POST['hours_fermeture_mercredi_midi'])
                && isset($_POST['hours_ouverture_mercredi_apres']) && isset($_POST['hours_fermeture_mercredi_soir']) 
                && isset($_POST['hours_ouverture_jeudi_matin']) && isset($_POST['hours_fermeture_jeudi_midi'])
                && isset($_POST['hours_ouverture_jeudi_apres']) && isset($_POST['hours_fermeture_jeudi_soir']) 
                && isset($_POST['hours_ouverture_vendredi_matin']) && isset($_POST['hours_fermeture_vendredi_midi'])
                && isset($_POST['hours_ouverture_vendredi_apres']) && isset($_POST['hours_fermeture_vendredi_soir']) 
                && isset($_POST['hours_ouverture_samedi_matin']) && isset($_POST['hours_fermeture_samedi_midi'])) {

                    //ajout de ':00' pour que les horaire ne prennent pas les secondes//
                $hours_ouverture_lundi_matin = $_POST['hours_ouverture_lundi_matin'] . ':00';
                $hours_fermeture_lundi_midi = $_POST['hours_fermeture_lundi_midi'] . ':00';
                $hours_ouverture_lundi_apres = $_POST['hours_ouverture_lundi_apres'] . ':00';
                $hours_fermeture_lundi_soir = $_POST['hours_fermeture_lundi_soir'] . ':00';

                $hours_ouverture_mardi_matin = $_POST['hours_ouverture_mardi_matin']. ':00';
                $hours_fermeture_mardi_midi = $_POST['hours_fermeture_mardi_midi']. ':00';
                $hours_ouverture_mardi_apres = $_POST['hours_ouverture_mardi_apres']. ':00';
                $hours_fermeture_mardi_soir = $_POST['hours_fermeture_mardi_soir']. ':00';

                $hours_ouverture_mercredi_matin = $_POST['hours_ouverture_mercredi_matin']. ':00';
                $hours_fermeture_mercredi_midi = $_POST['hours_fermeture_mercredi_midi']. ':00';
                $hours_ouverture_mercredi_apres = $_POST['hours_ouverture_mercredi_apres']. ':00';
                $hours_fermeture_mercredi_soir = $_POST['hours_fermeture_mercredi_soir']. ':00';

                $hours_ouverture_jeudi_matin = $_POST['hours_ouverture_jeudi_matin']. ':00';
                $hours_fermeture_jeudi_midi = $_POST['hours_fermeture_jeudi_midi']. ':00';
                $hours_ouverture_jeudi_apres = $_POST['hours_ouverture_jeudi_apres']. ':00';
                $hours_fermeture_jeudi_soir = $_POST['hours_fermeture_jeudi_soir']. ':00';

                $hours_ouverture_vendredi_matin = $_POST['hours_ouverture_vendredi_matin']. ':00';
                $hours_fermeture_vendredi_midi = $_POST['hours_fermeture_vendredi_midi']. ':00';
                $hours_ouverture_vendredi_apres = $_POST['hours_ouverture_vendredi_apres']. ':00';
                $hours_fermeture_vendredi_soir = $_POST['hours_fermeture_vendredi_soir']. ':00';

                $hours_ouverture_samedi_matin = $_POST['hours_ouverture_samedi_matin']. ':00';
                $hours_fermeture_samedi_midi = $_POST['hours_fermeture_samedi_midi']. ':00';
                
                    //on prepare la requete et on l'envoi//
                $sql = "UPDATE schedule SET hours_ouverture_lundi_matin = :hours_ouverture_lundi_matin, hours_fermeture_lundi_midi = :hours_fermeture_lundi_midi,
                                            hours_ouverture_lundi_apres = :hours_ouverture_lundi_apres, hours_fermeture_lundi_soir = :hours_fermeture_lundi_soir,
                                            hours_ouverture_mardi_matin = :hours_ouverture_mardi_matin, hours_fermeture_mardi_midi = :hours_fermeture_mardi_midi,
                                            hours_ouverture_mardi_apres = :hours_ouverture_mardi_apres, hours_fermeture_mardi_soir = :hours_fermeture_mardi_soir,
                                            hours_ouverture_mercredi_matin = :hours_ouverture_mercredi_matin, hours_fermeture_mercredi_midi = :hours_fermeture_mercredi_midi,
                                            hours_ouverture_mercredi_apres = :hours_ouverture_mercredi_apres, hours_fermeture_mercredi_soir = :hours_fermeture_mercredi_soir,
                                            hours_ouverture_jeudi_matin = :hours_ouverture_jeudi_matin, hours_fermeture_jeudi_midi = :hours_fermeture_jeudi_midi,
                                            hours_ouverture_jeudi_apres = :hours_ouverture_jeudi_apres, hours_fermeture_jeudi_soir = :hours_fermeture_jeudi_soir,
                                            hours_ouverture_vendredi_matin = :hours_ouverture_vendredi_matin, hours_fermeture_vendredi_midi = :hours_fermeture_vendredi_midi,
                                            hours_ouverture_vendredi_apres = :hours_ouverture_vendredi_apres, hours_fermeture_vendredi_soir = :hours_fermeture_vendredi_soir,
                                            hours_ouverture_samedi_matin = :hours_ouverture_samedi_matin, hours_fermeture_samedi_midi = :hours_fermeture_samedi_midi";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':hours_ouverture_lundi_matin', $hours_ouverture_lundi_matin, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_lundi_midi', $hours_fermeture_lundi_midi, PDO::PARAM_STR);
                $stmt->bindParam(':hours_ouverture_lundi_apres', $hours_ouverture_lundi_apres, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_lundi_soir', $hours_fermeture_lundi_soir, PDO::PARAM_STR);

                $stmt->bindParam(':hours_ouverture_mardi_matin', $hours_ouverture_mardi_matin, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_mardi_midi', $hours_fermeture_mardi_midi, PDO::PARAM_STR);
                $stmt->bindParam(':hours_ouverture_mardi_apres', $hours_ouverture_mardi_apres, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_mardi_soir', $hours_fermeture_mardi_soir, PDO::PARAM_STR);

                $stmt->bindParam(':hours_ouverture_mercredi_matin', $hours_ouverture_mercredi_matin, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_mercredi_midi', $hours_fermeture_mercredi_midi, PDO::PARAM_STR);
                $stmt->bindParam(':hours_ouverture_mercredi_apres', $hours_ouverture_mercredi_apres, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_mercredi_soir', $hours_fermeture_mercredi_soir, PDO::PARAM_STR);

                $stmt->bindParam(':hours_ouverture_jeudi_matin', $hours_ouverture_jeudi_matin, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_jeudi_midi', $hours_fermeture_jeudi_midi, PDO::PARAM_STR);
                $stmt->bindParam(':hours_ouverture_jeudi_apres', $hours_ouverture_jeudi_apres, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_jeudi_soir', $hours_fermeture_jeudi_soir, PDO::PARAM_STR);

                $stmt->bindParam(':hours_ouverture_vendredi_matin', $hours_ouverture_vendredi_matin, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_vendredi_midi', $hours_fermeture_vendredi_midi, PDO::PARAM_STR);
                $stmt->bindParam(':hours_ouverture_vendredi_apres', $hours_ouverture_vendredi_apres, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_vendredi_soir', $hours_fermeture_vendredi_soir, PDO::PARAM_STR);

                $stmt->bindParam(':hours_ouverture_samedi_matin', $hours_ouverture_samedi_matin, PDO::PARAM_STR);
                $stmt->bindParam(':hours_fermeture_samedi_midi', $hours_fermeture_samedi_midi, PDO::PARAM_STR);
                $stmt->execute();
            
                echo "<script>alert('Horaires modifiés avec succès')</script>";
            } else {
                echo "<script>alert('Erreur lors de la modification des horaires')</script>";
            }
        }
        
        ?>
</body>
</html>