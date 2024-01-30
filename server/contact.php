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
    <link rel="stylesheet" href="/styles/contact.css">
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
                        <li><a href="/server/entretien.php">Entretien</a></li>
                        <li><a href="/server/reparation.php">Réparation</a></li>
                        <li><a href="/server/occasion.php">Véhicule Occasion</a></li>
                        <li><a href="/server/contact.php">Contact</a></li>
                        <li><a href="/server/review.php">Avis</a></li>
                    </ul>
                </nav>        
        </div>
    </header>
    <main class="mainContact">
        <h1 class="titreContact">Contactez-nous</h1>
        <div class="form">
            <form action="contact.php" method="post" class="formContent">
                    <label class="label" for="nom">Nom :</label>
                    <input class="input" type="text" id="nom" name="nom" placeholder="Votre nom" required>
                    <label class="label" for="mail">Mail :</label>
                    <input class="input" type="email" id="mail" name="mail" placeholder="Votre mail" required>
                    <label class="label" for="tel">Téléphone :</label>
                    <input class="input" type="tel" id="tel" name="tel" placeholder="Votre téléphone" required>
                    <label class="label" for="message">Message :</label>
                    <textarea class="inputText" name="message" id="message" cols="30" rows="10" placeholder="Votre message" required></textarea>
                    <label class="label" for="scales">J'accepte les conditions d'utilisation :</label>
                    <input class="input" type="checkbox" id="scales" name="scales" required>
                    <input class="submit" type="submit" value="Envoyer">
            </form>
        </div>
        <?php
    //ajout du vehicule pour le contact personnalisé
        if (isset($_GET['id_car'])) {
            $id_car = $_GET['id_car'];
            $car_name = $_GET['name'];
            $car_date = $_GET['date'];
            $car_kilometer = $_GET['kilometer'];

            $message = "Bonjour,\n\nJe suis intéressé par le véhicule suivant :\n";
            $message .= "Nom: {$car_name}\n";
            $message .= "Année: {$car_date}\n";
            $message .= "Kilométrage: {$car_kilometer} km\n";

            
        }
?>

        <?php

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            require 'vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                //filtrage des données pour la sécurité
                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
                $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                //construction du mail
                $contentMail = "Nom : $nom\n";
                $contentMail .= "Mail : $mail\n";
                $contentMail .= "Téléphone : $tel\n";
                $contentMail .= "Message : $message\n";

                $destinataire = ""; //ajout de l'adresse mail ici et dans les parametre .env
                $sujet = "Message de Contact GARAGE V.PARROT";

    
                $email = new PHPMailer(true);

    try {
        //envoi de l'email si tout les parametre en .env sont correct
        $email->isSMTP();
        $email->Host = getenv('SMTP_HOST');
        $email->SMTPAuth = true;
        $email->Username = getenv('SMTP_USERNAME');
        $email->Password = getenv('SMTP_PASSWORD');
        $email->SMTPSecure = 'tls';
        $email->Port = getenv('SMTP_PORT');

        $email->setFrom($mail, $nom);
        $email->addAddress($destinataire);
        $email->Subject = $sujet;
        $email->Body = $contentMail;

        $email->send();

        header("Location: confirmation.php");
        exit();
    } catch (Exception $e) {
        echo "Une erreur s'est produite lors de l'envoi de l'e-mail : {$email->ErrorInfo}";
    }
}
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
    <script src="/scripts/entretien.js"></script>
</body>
</html>