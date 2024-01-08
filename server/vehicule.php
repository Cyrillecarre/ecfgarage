<?php
include "config.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicule</title>
</head>
<body>
    <div>
        <h1>Ajouter un véhicule sur le site</h1>
    </div>
    <div>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="image">Image du véhicule</label>
            <input type="file" id="image" name="image" required>
            <button type="submit" name="submitImage">Télécharger l'image</button>
        </form>
    </div>


    <?php 
    
    if (isset($_POST['submit'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_error = $_FILES['image']['error'];

        if ($image_error === 0) {
            $destination_finale = '/server/uploads/' . $image_name;
            move_uploaded_file($image_tmp_name, $destination_finale);
            echo "image télechargée avec succès";
        } else {
            echo "Erreur lors du téléchargement de l'image";
        }
    }

    ?>


    <div>
        <form method="post">
            <label for="marque">Marque du véhicule</label>
            <input type="text" id="marque" name="marque" required>
            <label for="nom">Nom du véhicule</label>
            <input type="text" id="nom" name="nom" required>
            <label for="annee">Année du véhicule</label>
            <input type="text" id="annee" name="annee" required>
            <label for="kilometer">Kilométrage du véhicule</label>
            <input type="text" id="kilometer" name="kilometer" required>
            <label for="carburant">Carburant du véhicule</label>
            <select name="carburant" id="carburant">
                <option value="essence">Essence</option>
                <option value="diesel">Diesel</option>
                <option value="electrique">Electrique</option>
                <option value="hybride">Hybride</option>
                <option value="gpl">GPL</option>
                <option value="hydrogene">Hydrogène</option>
                <option value="ethanol">Ethanol</option>
            </select>
            <label for="boiteDeVitesse">Boite de vitesse</label>
            <select name="boiteDeVitesse" id="boite">
                <option value="manuelle">Manuelle</option>
                <option value="automatique">Automatique</option>
            </select>
            <label for="power">Puissance fiscale</label>
            <input type="text" id="power" name="power" required>
            <select name="gate" id="gate">
                <option value="5">5 portes</option>
                <option value="3">3 portes</option>
            </select>
            <label for="prix">Prix du véhicule</label>
            <input type="text" id="prix" name="prix" required>
            <input type="submit" value="Ajouter le véhicule">
        </form>
</body>
</html>