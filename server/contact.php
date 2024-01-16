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
    <main>
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

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            require 'vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
                $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $contentMail = "Nom : $nom\n";
                $contentMail .= "Mail : $mail\n";
                $contentMail .= "Téléphone : $tel\n";
                $contentMail .= "Message : $message\n";

                $destinataire = "garageparrot@gmail.com";
                $sujet = "Message de Contact GARAGE V.PARROT";

    
                $email = new PHPMailer(true);

    try {
        
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
</body>
</html>