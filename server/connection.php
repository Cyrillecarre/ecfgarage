<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/connection.css">
    <title>Formulaire de connection</title>
</head>
<body>
    <div class="formBody">
        <form action="connection.php" class="form" method="POST">
            <label for="pseudo">Nom de connection</label>
            <input type="text" id="pseudo" name="pseudo" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>
    <div class="retour">
        <a href="/index.html" class="retour">Retour à l'accueil</a>
    </div>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST['pseudo']) && isset($_POST['password'])) {
                $pseudo = $_POST['pseudo'];
                $password = $_POST['password'];
                if ($pseudo === 'admin' && $password === 'admin') {
                    $_SESSION['admin'] = true;
                    $_SESSION['pseudo'] = $pseudo;
                    setcookie('pseudo', $pseudo, time() + 3600, '/');
                    header('location: /server/prive.php');
                    
                } if ($pseudo === 'user' && $password === 'user') {
                    $_SESSION['admin'] = false;
                    $_SESSION['pseudo'] = $pseudo;
                    setcookie('pseudo', $pseudo, time() + 3600, '/');
                    header('location: /server/prive.php');
                
                } else {
                    echo "Erreur d'identifiant ou de mot de passe.";
                }
            }
        }
 ?>

</body>
</html>