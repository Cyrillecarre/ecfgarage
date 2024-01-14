<?php
include('bdd.php');

$sql = "SELECT * FROM car";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/occasion.css">
    <title>Véhicule</title>
</head>
<body>
<header class="header">
        <img class="logo" src="/image_ecf/logo.jpg" alt="logo">
        <div class="headerNav">
            <div class="header2">
                <a href="/server/connection.php"><i class="fa-solid fa-user-secret"></i> Connection</a>
                <p>TEL: 06 71 06 19 19</p>
                <p>Mail: contact@gmail.com</p>
            </div>   
            
                <nav class="nav">
                    <ul class="navListe">
                        <li><a href="/index.html">Accueil</a></li>
                        <li><a href="/pages/entretien.html">Entretien</a></li>
                        <li><a href="/pages/reparation.html">Réparation</a></li>
                        <li><a href="/server/occasion.php">Véhicule Occasion</a></li>
                        <li><a href="/pages/contact.html">Contact</a></li>
                    </ul>
                </nav>        
        </div>
    </header>
    <div class="occasionAccueil">
        <h1>Liste des véhicules</h1>
    </div>
    <div class="vehiculeContener">
        <?php
        if ($result !== false && $result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='vehiculeContent'>";
                echo "<h2 class='vehiculeName'>" . $row["name"] . "</h2>";
                $image_path = $row["image_path"];
                echo '<img src="uploads/' . basename($image_path) . '" alt="Image du véhicule" class="imageContent">';
                echo "<div class='vehiculeDescription'>";
                echo "<p class='vehiculeText'>Année: " . $row["date"] ."</p>";
                echo "<p class='vehiculeText'>Kilométrage: " . $row["kilometer"] . " km" . "</p>";
                echo "<p class='vehiculeText'>Carburant: " . $row["energy"] . "</p>";
                echo "<p class='vehiculeText'>Boite de vitesse: " . $row["transmission"] . "</p>";
                echo "<p class='vehiculeText'>Puissance fiscale: " . $row["power"] . "</p>";
                echo "<p class='vehiculeText'>Nombre de portes: " . $row["gate"] . "</p>";
                echo "<p class='vehiculeText'>Prix: " . $row["price"] . " €" . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "Aucun véhicule trouvé.";
        }
        ?>
    </div>
</body>
</html>
