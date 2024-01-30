<?php
//affichage dynamique des horaires//
include('bdd.php');  
$sql = "SELECT admin_id,
IFNULL (SUBSTRING(hours_ouverture_lundi_matin, 1, 5), 'Fermé') AS hours_ouverture_lundi_matin,
IFNULL (SUBSTRING(hours_fermeture_lundi_midi, 1, 5), 'Fermé') AS hours_fermeture_lundi_midi,
IFNULL (SUBSTRING(hours_ouverture_lundi_apres, 1, 5), 'Fermé') AS hours_ouverture_lundi_apres,
IFNULL (SUBSTRING(hours_fermeture_lundi_soir, 1, 5), 'Fermé') AS hours_fermeture_lundi_soir,
IFNULL (SUBSTRING(hours_ouverture_mardi_matin, 1, 5), 'Fermé') AS hours_ouverture_mardi_matin,
IFNULL (SUBSTRING(hours_fermeture_mardi_midi, 1, 5), 'Fermé') AS hours_fermeture_mardi_midi,
IFNULL (SUBSTRING(hours_ouverture_mardi_apres, 1, 5), 'Fermé') AS hours_ouverture_mardi_apres,
IFNULL (SUBSTRING(hours_fermeture_mardi_soir, 1, 5), 'Fermé') AS hours_fermeture_mardi_soir,
IFNULL (SUBSTRING(hours_ouverture_mercredi_matin, 1, 5), 'Fermé') AS hours_ouverture_mercredi_matin,
IFNULL (SUBSTRING(hours_fermeture_mercredi_midi, 1, 5), 'Fermé') AS hours_fermeture_mercredi_midi,
IFNULL (SUBSTRING(hours_ouverture_mercredi_apres, 1, 5), 'Fermé') AS hours_ouverture_mercredi_apres,
IFNULL (SUBSTRING(hours_fermeture_mercredi_soir, 1, 5), 'Fermé') AS hours_fermeture_mercredi_soir,
IFNULL (SUBSTRING(hours_ouverture_jeudi_matin, 1, 5), 'Fermé') AS hours_ouverture_jeudi_matin,
IFNULL (SUBSTRING(hours_fermeture_jeudi_midi, 1, 5), 'Fermé') AS hours_fermeture_jeudi_midi,
IFNULL (SUBSTRING(hours_ouverture_jeudi_apres, 1, 5), 'Fermé') AS hours_ouverture_jeudi_apres,
IFNULL (SUBSTRING(hours_fermeture_jeudi_soir, 1, 5), 'Fermé') AS hours_fermeture_jeudi_soir,
IFNULL (SUBSTRING(hours_ouverture_vendredi_matin, 1, 5), 'Fermé') AS hours_ouverture_vendredi_matin,
IFNULL (SUBSTRING(hours_fermeture_vendredi_midi, 1, 5), 'Fermé') AS hours_fermeture_vendredi_midi,
IFNULL (SUBSTRING(hours_ouverture_vendredi_apres, 1, 5), 'Fermé') AS hours_ouverture_vendredi_apres,
IFNULL (SUBSTRING(hours_fermeture_vendredi_soir, 1, 5), 'Fermé') AS hours_fermeture_vendredi_soir,
IFNULL (SUBSTRING(hours_ouverture_samedi_matin, 1, 5), 'Fermé') AS hours_ouverture_samedi_matin,
IFNULL (SUBSTRING(hours_fermeture_samedi_midi, 1, 5), 'Fermé') AS hours_fermeture_samedi_midi
 FROM schedule";
$result = $connect->query($sql);
if ($result) {
    if ($result->rowCount() > 0) {
        $schedule = $result->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Aucune ligne trouvée dans la table schedule.";
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . $connect->errorInfo()[2];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/review.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Avis</title>
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
            <div class="burger-menu" id="burger-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>      
                <nav class="nav">
                    <ul class="navListe">
                        <li class="navList"><a href="/index.php">Accueil</a></li>
                        <li class="navList"><a href="/server/entretien.php">Entretien</a></li>
                        <li class="navList"><a href="/server/reparation.php">Réparation</a></li>
                        <li class="navList"><a href="/server/occasion.php">Véhicule Occasion</a></li>
                        <li class="navList"><a href="/server/contact.php">Contact</a></li>
                        <li class="navList"><a href="/server/review.php">Avis</a></li>
                    </ul>
                </nav>        
        </div>
    </header>
    <main class="mainAvis">
        <div class="avis">
            <h1>Avis des consommateurs</h1>
        </div>
        <div class="form">
            <form class="formContent" action="review.php" method="post">
                <div>
                    <label class="label" for="note">Note :</label>
                </div>
                <div class="etoile">
                    <input type="radio" id="etoile1" name="note" value="1">
                    <label for="etoile1">&#9733;1</label>
                    <input type="radio" id="etoile2" name="note" value="2">
                    <label for="etoile2">&#9733;2</label>
                    <input type="radio" id="etoile3" name="note" value="3">
                    <label for="etoile3">&#9733;3</label>
                    <input type="radio" id="etoile4" name="note" value="4">
                    <label for="etoile4">&#9733;4</label>
                    <input type="radio" id="etoile5" name="note" value="5">
                    <label for="etoile5">&#9733;5</label>
                </div>
                <div>
                    <label class="label" for="name">Prénom :</label>
                </div>
                <div>
                    <input class="input" type="text" id="name" name="name" placeholder="Votre nom" required>
                </div>
                <div>
                    <label class="label" for="date">Date :</label>
                </div>
                <div>
                    <input class="input" type="date" id="date" name="date" required>
                </div>
                <div>
                    <label class="label" for="content">Votre avis :</label>
                </div>
                <div>
                    <textarea class="inputText" name="content" id="content" cols="30" rows="10" placeholder="Votre avis" required></textarea>
                </div>
                    <input class="submit" type="submit" value="Envoyer">
                </form>
            </div>
                
            <?php 
            //enregistrement en table reviewValid//
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['note']) && isset($_POST['name']) && isset($_POST['date']) && isset($_POST['content'])){
                    $note = filter_input(INPUT_POST, 'note' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $name = filter_input(INPUT_POST, 'name' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $date = filter_input(INPUT_POST, 'date' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $content = filter_input(INPUT_POST, 'content' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $sql = "INSERT INTO reviewValid (note, name, date, content) VALUES (:note, :name, :date, :content)";
                    $stmt = $connect->prepare($sql);
                    $stmt->bindParam(':note', $note);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':date', $date);
                    $stmt->bindParam(':content', $content);
                    $stmt->execute();

                    echo "<script>alert('Avis envoyé, en attente de validation')</script>";
                } else {
                echo "<script>alert('Erreur dans l'envoi de votre avis')</script>";
                    };
                };
                ?>
    </main>
    <footer class="footer">
        <div>
            <h2>Horaires <i class="fa-regular fa-clock"></i></h2>
            <table>
                        <tr>
                          <td>Lundi :</td>
                          <td><?php echo $schedule['hours_ouverture_lundi_matin'] . ' / ' . $schedule['hours_fermeture_lundi_midi']. 
                          ' - ' . $schedule['hours_ouverture_lundi_apres']. ' / ' . $schedule['hours_fermeture_lundi_soir']; ?></td>
                        </tr>
                        <tr>
                          <td>Mardi :</td>
                          <td><?php echo $schedule['hours_ouverture_mardi_matin'] . ' / ' . $schedule['hours_fermeture_mardi_midi']. 
                          ' - ' . $schedule['hours_ouverture_mardi_apres']. ' / ' . $schedule['hours_fermeture_mardi_soir']; ?></td>
                        </tr>
                        <tr>
                          <td>Mercredi :</td>
                          <td><?php echo $schedule['hours_ouverture_mercredi_matin'] . ' / ' . $schedule['hours_fermeture_mercredi_midi']. 
                          ' - ' . $schedule['hours_ouverture_mercredi_apres']. ' / ' . $schedule['hours_fermeture_mercredi_soir']; ?></td>
                        </tr>
                        <tr>
                          <td>Jeudi :</td>
                          <td><?php echo $schedule['hours_ouverture_jeudi_matin'] . ' / ' . $schedule['hours_fermeture_jeudi_midi']. 
                          ' - ' . $schedule['hours_ouverture_jeudi_apres']. ' / ' . $schedule['hours_fermeture_jeudi_soir']; ?></td>
                        </tr>
                        <tr>
                          <td>Vendredi :</td>
                          <td><?php echo $schedule['hours_ouverture_vendredi_matin'] . ' / ' . $schedule['hours_fermeture_vendredi_midi']. 
                          ' - ' . $schedule['hours_ouverture_vendredi_apres']. ' / ' . $schedule['hours_fermeture_vendredi_soir']; ?></td>
                        </tr>
                        <tr>
                          <td>Samedi :</td>
                          <td><?php echo $schedule['hours_ouverture_samedi_matin'] . ' / ' . $schedule['hours_fermeture_samedi_midi']; ?></td>
                        </tr>
                        <tr>
                          <td>Dimanche :</td>
                          <td>Fermé</td>
                        </tr>
                      </table>
        </div>
        <div>
            <h2>Adresse <i class="fa-solid fa-location-dot"></i> </h2>
            <p>Garage V.PARROT</p>
            <p>29 rue Georges Ohnet</p>
            <p>31000 Toulouse</p>
        </div>
        <div>
            <h2>Contact</h2>
            <p>TEL: 06 71 06 19 19</p>
            <p>Mail:
        </p>
        </div>
    </footer>
    <script src="/scripts/review.js"></script>
</body>
</html>