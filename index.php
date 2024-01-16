<?php
include('server/bdd.php');  
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
    <link rel="stylesheet" href="/styles/accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <title>Document</title>
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
                        <li class="navList"><a href="/index.php">Accueil</a></li>
                        <li class="navList"><a href="/pages/entretien.html">Entretien</a></li>
                        <li class="navList"><a href="/pages/reparation.html">Réparation</a></li>
                        <li class="navList"><a href="/server/occasion.php">Véhicule Occasion</a></li>
                        <li class="navList"><a href="/server/contact.php">Contact</a></li>
                    </ul>
                </nav>        
        </div>
    </header>
    <main class="accueil">
        <div class="mainAccueil">
            <h1 class="titreAccueil">Bienvenue sur le site <br><span class="titreSpan">GARAGE V.PARROT</span></h1>
            <p>Garage V.PARROT vous propose également des prestations de réparation et d’entretien de votre véhicule.
                Nous vous proposons des prestations de qualité à des prix compétitifs.
            </p>
            <p>Garage V.PARROT est spécialisée dans la réparation et la vente automobile sur Toulouse. 
                Grâce à sa parfaite connaissance du marché automobile européen, Garage V.PARROT vous invite à 
                découvrir son parc de véhicules d’occasions.
            </p>
            <div class="article">
                <article class="articleContent">
                    <h2>Mandataire Automobile <br>à votre service</h2>
                    <p>Garage V.PARROT vous propose également des prestations de réparation et d’entretien de votre véhicule. 
                        Nous vous proposons des prestations de qualité à des prix compétitifs.
                    </p>
                </article>
                <article class="articleContent">
                    <h2>Solution de Financement <br>de votre véhicule (loa, crédit bail)</h2>
                    <p>Garage V.PARROT est spécialisée dans la réparation et la vente automobile sur Toulouse. 
                        Grâce à sa parfaite connaissance du marché automobile européen, Garage V.PARROT vous invite à 
                        découvrir son parc de véhicules d’occasions.
                    </p>
                </article>
            </div>
            <div class="aPropos">
                <h2 class="titreAccueil">à propos de <br><span class="titreSpan">GARAGE V.PARROT</span></h2>
                <p>Garage V.PARROT vend des voitures d’occasion reconditionné mais également des véhicules neufs de toutes marques jusqu’à -40%. 
                    Notre catalogue de véhicules d’occasion est très vaste. 
                    Vous pouvez dès à présent prendre rendez-vous pour essayer votre future voiture.
                </p>
            </div>
        </div>
    </main>
    <main class="achat">
        <div class="achatImg">
            <img src="/image_ecf/accueilachat.png" alt="">
        </div>
        <div class="achatLogo">
            <i class="fa-solid fa-gear"></i>
            <i class="fa-solid fa-user-secret"></i>
            <i class="fa-solid fa-code-compare"></i>
        </div>
            <div class="achatText"> 
                    <h2>Achat</h2>
                    <p>L’entreprise Garage V.PARROT possède une grande connaissance du marché automobile et trouve des véhicules au meilleur prix.</p>
                    <h2>Vente</h2>
                    <p>Garage V.PARROT vous fait économiser jusqu’à 40% sur le prix de vente de votre voiture neuve.</p>
                    <h2>Reprise</h2>
                    <p>Nous reprenons votre véhicule au meilleur prix. Contactez-nous pour en savoir plus.</p>
            </div>
    </main>

    <main class="mainOuSommeNous">
        <h1 class="titreAccueil">OU SOMMES-NOUS ?</h1>
        <div class="ouSommeNous">
            <div class="ouSommeNousAdresse">
                <div class="ouSommeNousContent">
                    <i class="fa-solid fa-location-dot iColor"></i>   
                    <p>29 rue Georges Ohnet, 31000 Toulouse</p>  
                </div>
                <div class="ouSommeNousContent">
                    <i class="fa-solid fa-phone iColor"></i>
                    <p>TEL: 06 71 06 19 19</p>
                </div>
                <div class="ouSommeNousContent">
                    <i class="fa-regular fa-clock iColor"></i>
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
            </div>
            <div id="map" class="map">
                api map
            </div>   
        </div>
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

    <script src="/scripts/accueil.js"></script>
</body>
</html>