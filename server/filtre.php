
<?php 
      include('bdd.php');  
      //recupere les info du filtre//
        $prixMax = $_POST['rangeInputPrix'];
        $anneeMin = $_POST['rangeInputAnnee'];
        $kilometerMax = $_POST['rangeInputKm'];

        //on selectionne dans la table car//
        $sql = "SELECT * FROM car WHERE price <= :prixMax AND date >= :anneeMin AND kilometer <= :kilometerMax";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':prixMax', $prixMax, PDO::PARAM_INT);
        $stmt->bindParam(':anneeMin', $anneeMin, PDO::PARAM_INT);
        $stmt->bindParam(':kilometerMax', $kilometerMax, PDO::PARAM_INT);
        $stmt->execute();

        $cars = [];

        //affichage sur la page vehicule //
        $html = '';
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $html .= "<div class='vehiculeContent'>";
                $html .= "<h2 class='vehiculeName'>" . $row["name"] . "</h2>";
                $image_path = $row["image_path"];
                $html .= '<img class="imageContent" src="uploads/' . basename($image_path) . '" alt="Image du véhicule">';
                $html .= "<div class='vehiculeDescription'>";
                $html .= "<p class='vehiculeTextAnnee'>Année: " . $row["date"] ."</p>";
                $html .= "<p class='vehiculeTextKm'>Kilométrage: " . $row["kilometer"] . " km" . "</p>";
                $html .= "<p class='vehiculeText'>Carburant: " . $row["energy"] . "</p>";
                $html .= "<p class='vehiculeText'>Boite de vitesse: " . $row["transmission"] . "</p>";
                $html .= "<p class='vehiculeText'>Puissance fiscale: " . $row["power"] . "</p>";
                $html .= "<p class='vehiculeText'>Nombre de portes: " . $row["gate"] . "</p>";
                $html .= "<p class='vehiculeTextPrix'>Prix: " . $row["price"] . " €" . "</p>";
                $html .= "<a href='/server/optionSup.php?id_car={$row["id_car"]}' class='vehiculeLink'>Voir plus d'option?</a>";
                $html .= "</div>";
                $html .= "</div>";
            }
            } else {
            $html = "Aucun véhicule trouvé.";
            }

            echo $html;
            
?>