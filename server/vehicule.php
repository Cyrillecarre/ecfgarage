<?php
include('bdd.php');
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
        $unique_image_name = uniqid('image_') . '_' . time() . '.' . pathinfo($image_name, PATHINFO_EXTENSION);
        $destination_final = "uploads/".$unique_image_name;
        
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
    $stmt_insert_car->bindParam(':image_path', $unique_image_name, PDO::PARAM_STR);
    $stmt_insert_car->execute();


        $optionImages = array($_FILES['image2'], $_FILES['image3'], $_FILES['image4'], $_FILES['image5']);
            foreach ($optionImages as $optionImage) {
                if ($optionImage['error'] === 0) {
                    $unique_image_options_name = uniqid('image_') . '_' . time() . '.' . pathinfo($image_name, PATHINFO_EXTENSION);
                    $destination_final = "uploads/" . $unique_image_options_name;
                    move_uploaded_file($optionImage['tmp_name'], $destination_final);

                    $sql_insert_option_image = "INSERT INTO options (data_type, data_content, car_id) 
                                        VALUES ('photo', :image_path, LAST_INSERT_ID())";

                    $stmt_insert_option_image = $connect->prepare($sql_insert_option_image);
                    $stmt_insert_option_image->bindParam(':image_path', $unique_image_options_name, PDO::PARAM_STR);
                    $stmt_insert_option_image->execute();
                        }
                    }

        $options = array($_POST['additionnelOption1'], $_POST['additionnelOption2'], $_POST['additionnelOption3'], $_POST['additionnelOption4'], $_POST['additionnelOption5']);
            foreach ($options as $option) {
                if (!empty($option)) {
                    $sql_insert_option = "INSERT INTO options (data_type, data_content, car_id) 
                                        VALUES ('option', :option_content, LAST_INSERT_ID())";

                    $stmt_insert_option = $connect->prepare($sql_insert_option);
                    $stmt_insert_option->bindParam(':option_content', $option, PDO::PARAM_STR);
                    $stmt_insert_option->execute();
                        }
                    }
        
        echo '<script>alert("Véhicule ajouté avec succès!");</script>';
    } else {
        echo '<script>alert("Erreur lors du téléchargement!");</script>';
    }
} 

?>
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /server/connection.php");
    exit();
}
?>

<?php
if (isset($_POST['submitDelete'])) {
    $deleteName = $_POST['deleteName'];
    $deleteKilometer = $_POST['deleteKilometer'];

    $sql_get_car_id = "SELECT id_car FROM car WHERE name = :name AND kilometer = :kilometer";
    $stmt_get_car_id = $connect->prepare($sql_get_car_id);
    $stmt_get_car_id->bindParam(':name', $deleteName, PDO::PARAM_STR);
    $stmt_get_car_id->bindParam(':kilometer', $deleteKilometer, PDO::PARAM_STR);
    $stmt_get_car_id->execute();
    $car_id_result = $stmt_get_car_id->fetch(PDO::FETCH_ASSOC);

    if ($car_id_result && isset($car_id_result['id_car'])) {
        $deleteCar_id = $car_id_result['id_car'];

        $sql_get_images = "SELECT image_path FROM options WHERE car_id = :car_id AND data_type = 'photo'";
        $stmt_get_images = $connect->prepare($sql_get_images);
        $stmt_get_images->bindParam(':car_id', $deleteCar_id, PDO::PARAM_STR);
        $stmt_get_images->execute();
        $images_result = $stmt_get_images->fetchAll(PDO::FETCH_ASSOC);

        foreach ($images_result as $image) {
            $image_delete = "uploads/" . $image['image_path'];
            if (file_exists($image_delete)) {
                unlink($image_delete);
            }
        }

        $sql_delete_options = "DELETE FROM options WHERE car_id = :car_id";
        $stmt_delete_options = $connect->prepare($sql_delete_options);
        $stmt_delete_options->bindParam(':car_id', $deleteCar_id, PDO::PARAM_STR);
        $stmt_delete_options->execute();

        $sql_delete_car = "DELETE FROM car WHERE id_car = :id_car";
        $stmt_delete_car = $connect->prepare($sql_delete_car);
        $stmt_delete_car->bindParam(':id_car', $deleteCar_id, PDO::PARAM_STR);

        if ($stmt_delete_car->execute()) {
            echo '<script>alert("Véhicule sélectionné supprimé avec succès!");</script>';
        } else {
            echo '<script>alert("Erreur lors de la suppression du véhicule sélectionné!");</script>';
        }
    } else {
        echo '<script>alert("Véhicule non trouvé!");</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/vehicule.css">
    <title>Véhicule</title>
</head>
<body class="body">
    <div class="vehiculeTitre">
        <h1>Ajouter un véhicule</h1>
    </div>
    <div class="form">
        <form class="formContent" method="post" action="vehicule.php" enctype="multipart/form-data">
            <label class="label" for="image">Image du véhicule :</label>
            <input class="input" type="file" id="image" name="image" required>
            <label class="label" for="name">Nom du véhicule :</label>
            <input class="input" type="text" id="name" name="name" placeholder="Nom" required>
            <label class="label" for="date">Année du véhicule :</label>
            <input class="input" type="text" id="date" name="date" placeholder="Années" required>
            <label class="label" for="kilometer">Kilométrage du véhicule :</label>
            <input class="input" type="text" id="kilometer" name="kilometer" placeholder="Kilomètres" required>
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
            <input class="input" type="text" id="power" name="power" placeholder="Chevaux fiscaux" required>
            <label class="label" for="gate">Nombre de portes :</label>
            <select class="input" name="gate" id="gate">
                <option value="5">5 portes</option>
                <option value="3">3 portes</option>
            </select>
            <label class="label" for="price">Prix du véhicule :</label>
            <input class="input" type="text" id="price" name="price" placeholder="Prix" required>
            <button class="option" type="text" name="option">Ajouter des options et photo supplementaire?</button>
                <label class="label optionAdditionnel" for="image2">Image 2 :</label>
                <input class="input optionAdditionnel" type="file" id="image2" name="image2">
                <label class="label optionAdditionnel" for="image3">Image 3 :</label>
                <input class="input optionAdditionnel" type="file" id="image3" name="image3">
                <label class="label optionAdditionnel" for="image4">Image 4 :</label>
                <input class="input optionAdditionnel" type="file" id="image4" name="image4">
                <label class="label optionAdditionnel" for="image5">Image 5 :</label>
                <input class="input optionAdditionnel" type="file" id="image5" name="image5">
                <label class="label optionAdditionnel" for="option1">option 1 :</label>
                <input class="input optionAdditionnel" type="text" name="additionnelOption1" placeholder="Option supplémentaire 1">
                <label class="label optionAdditionnel" for="option2">option 2 :</label>
                <input class="input optionAdditionnel" type="text" name="additionnelOption2" placeholder="Option supplémentaire 2">
                <label class="label optionAdditionnel" for="option3">option 3 :</label>
                <input class="input optionAdditionnel" type="text" name="additionnelOption2" placeholder="Option supplémentaire 3">
                <label class="label optionAdditionnel" for="option4">option 4 :</label>
                <input class="input optionAdditionnel" type="text" name="additionnelOption2" placeholder="Option supplémentaire 4">
                <label class="label optionAdditionnel" for="option5">option 5 :</label>
                <input class="input optionAdditionnel" type="text" name="additionnelOption2" placeholder="Option supplémentaire 5">
            
            <input class="submit" type="submit" name="submit" value="Ajouter le véhicule">
        </form>
    </div>
    <main class="vehiculeTitre">
        <h1>Supprimer un véhicule</h1>
        <div class="form">
            <form class="formContent" method="post" action="vehicule.php">
                <label class="label2" for="deleteName">Nom du véhicule :</label>
                <input class="input" type="text" id="deleteName" name="deleteName" required>
                <label class="label2" for="deleteKilometer">Kilométrage du véhicule :</label>
                <input class="input" type="text" id="deleteKilometer" name="deleteKilometer" required>
                <input class="submit" type="submit" name="submitDelete" value="Supprimer le véhicule">
            </form>
        </div>
    </main>
    <aside>
        <form method="post" action="vehicule.php">
            <input type="hidden" name="logout" value="true">
            <button class="submitRetour" type="submit">Retour</button>
        </form>
    </aside>
<script src="/scripts/vehicule.js"></script>
</body>
</html>