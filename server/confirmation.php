<?php
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
    <link rel="stylesheet" href="/styles/confirmation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Contact</title>
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
                        <li><a href="/index.php">Accueil</a></li>
                        <li><a href="/pages/entretien.html">Entretien</a></li>
                        <li><a href="/pages/reparation.html">Réparation</a></li>
                        <li><a href="/server/occasion.php">Véhicule Occasion</a></li>
                        <li><a href="/server/contact.php">Contact</a></li>
                    </ul>
                </nav>        
        </div>
    </header>
    <main class="mainContent">
        <h1 class="titreContact">Confirmation d'envoi E-mail</h1>
        <p>Merci de nous avoir contacté, nous vous repondrons dans les plus bref delais.</p><br>
        <p>Nous vous invitons à regarder notre liste de véhicule d'occasion :</p><a href="/server/occasion.php">Véhicule Occasion</a>
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

    <script src="/scripts/entretien.js"></script>
</body>
</html>
        