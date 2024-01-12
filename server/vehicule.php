<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/vehicule.css">
    <title>Véhicule</title>
</head>
<body>
    <div class="vehiculeTitre">
        <h1>Ajouter un véhicule</h1>
    </div>
    <div class="form">
        <form class="formContent" method="post" action="vehicule.php" enctype="multipart/form-data">
            <label class="label" for="image">Image du véhicule :</label>
            <input class="input" type="file" id="image" name="image" required>
            <label class="label" for="name">Nom du véhicule :</label>
            <input class="input" type="text" id="name" name="name" required>
            <label class="label" for="date">Année du véhicule :</label>
            <input class="input" type="text" id="date" name="date" required>
            <label class="label" for="kilometer">Kilométrage du véhicule :</label>
            <input class="input" type="text" id="kilometer" name="kilometer" required>
            <label class="label" for="energy">Carburant du véhicule :</label>
            <select class="input" name="energy" id="energy">
                <option value="essence">Essence</option>
                <option value="diesel">Diesel</option>
                <option value="electrique">Electrique</option>
                <option value="hybride">Hybride</option>
                <option value="gpl">GPL</option>
                <option value="hydrogene">Hydrogène</option>
                <option value="ethanol">Ethanol</option>
            </select>
            <label class="label" for="transmission">Boite de vitesse :</label>
            <select class="input" name="transmission" id="transmission">
                <option value="manuelle">Manuelle</option>
                <option value="automatique">Automatique</option>
            </select>
            <label class="label" for="power">Puissance fiscale :</label>
            <input class="input" type="text" id="power" name="power" required>
            <label class="label" for="gate">Nombre de portes :</label>
            <select class="input" name="gate" id="gate">
                <option value="5">5 portes</option>
                <option value="3">3 portes</option>
            </select>
            <label class="label" for="price">Prix du véhicule :</label>
            <input class="input" type="text" id="price" name="price" required>
            <input class="submit" type="submit" name="submit" value="Ajouter le véhicule">
        </form>
    </div>
    <main class="vehiculeTitre">
        <h1>Supprimer un véhicule</h1>
        <div class="form">
            <form class="formContent" method="post" action="vehicule.php">
                <label class="label" for="deleteName">Nom du véhicule :</label>
                <input class="input" type="text" id="deleteName" name="deleteName" required>
                <label class="label" for="deleteKilometer">Kilométrage du véhicule :</label>
                <input class="input" type="text" id="deleteKilometer" name="deleteKilometer" required>
                <input class="submit" type="submit" name="submitDelete" value="Supprimer le véhicule">
            </form>
        </div>
    </main>
    
    <?php
include('bdd.php');
//script pour ajouter un véhicule//
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $kilometer = $_POST['kilometer'];
    $energy = $_POST['energy'];
    $transmission = $_POST['transmission'];
    $power = $_POST['power'];
    $gate = $_POST['gate'];
    $price = $_POST['price'];
    
    
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_error = $_FILES['image']['error'];
    
    if ($image_error === 0) {
        $destination_final = "uploads/".$image_name;
        
        move_uploaded_file($image_tmp_name, $destination_final);
        
        $sql_insert_car = "INSERT INTO car (name, date, kilometer, energy, transmission, power, gate, price, image_path) 
                           VALUES (:name, :date, :kilometer, :energy, :transmission, :power, :gate, :price, :image_path)";

$stmt_insert_car = $connect->prepare($sql_insert_car);
$stmt_insert_car->bindParam(':name', $name, PDO::PARAM_STR);
$stmt_insert_car->bindParam(':date', $date, PDO::PARAM_STR);
$stmt_insert_car->bindParam(':kilometer', $kilometer, PDO::PARAM_STR);
$stmt_insert_car->bindParam(':energy', $energy, PDO::PARAM_STR);
$stmt_insert_car->bindParam(':transmission', $transmission, PDO::PARAM_STR);
$stmt_insert_car->bindParam(':power', $power, PDO::PARAM_STR);
$stmt_insert_car->bindParam(':gate', $gate, PDO::PARAM_STR);
$stmt_insert_car->bindParam(':price', $price, PDO::PARAM_STR);
$stmt_insert_car->bindParam(':image_path', $image_name, PDO::PARAM_STR);

if ($stmt_insert_car->execute()) {
    echo '<script>alert("Véhicule ajouté avec succès!");</script>';
} else {
    echo '<script>alert("Erreur lors de l\'ajout!");</script>';
}
} else {
    echo '<script>alert("Erreur lors du téléchargement!");</script>';
}
}
?>

<?php
//script pour supprimer un véhicule//
if (isset($_POST['submitDelete'])) {
    $deleteName = $_POST['deleteName'];
    $deleteKilometer = $_POST['deleteKilometer'];

    $sql_get_image = "SELECT image_path FROM car WHERE name = :name AND kilometer = :kilometer";
    $stmt_get_image = $connect->prepare($sql_get_image);
    $stmt_get_image->bindParam(':name', $deleteName, PDO::PARAM_STR);
    $stmt_get_image->bindParam(':kilometer', $deleteKilometer, PDO::PARAM_STR);
    $stmt_get_image->execute();
    $result = $stmt_get_image->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['image_path'])) {
        $image_delete = "uploads/" . $result['image_path'];
        if (file_exists($image_delete)) {
            unlink($image_delete);
        }
    }

    $sql_delete_car = "DELETE FROM car WHERE name = :name AND kilometer = :kilometer";
    $stmt_delete_car = $connect->prepare($sql_delete_car);
    $stmt_delete_car->bindParam(':name', $deleteName, PDO::PARAM_STR);
    $stmt_delete_car->bindParam(':kilometer', $deleteKilometer, PDO::PARAM_STR);

    if ($stmt_delete_car->execute()) {
        echo '<script>alert("Véhicule sélectionné supprimé avec succès!");</script>';
    } else {
        echo '<script>alert("Erreur lors de la suppression du véhicule sélectionné!");</script>';
    }
}
?>
</body>
</html>