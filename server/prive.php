<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/prive.css">
    <title>Document</title>
</head>
<body class="body">
    <h1 class="titrePrive">Bienvenue sur la page privé du Garage V.PARROT</h1>
    <?php if (isset($_SESSION['admin']) AND $_SESSION['admin'] == true) {;?>
        <div >
            <h1 class="titreM">Bonjour MONSIEUR PARROT</h1>
            <div class="priveContent">
                <p>Que voulez-vous modifier sur votre site web?</p>
                <nav>
                    <ul class="priveLi">
                        <li><a href="vehicule.php">Véhicules</a></li>
                        <li><a href="userAdd.php">Employés ou Admin</a></li>
                        <li><a href="schedule.php">Horaires</a></li>
                        <li><a href="valid_review.php">Avis</a></li>
                    </ul>
                </nav>
            </div>
            <aside>
                <form class="form" method="post" action="prive.php">
                    <input label="label" type="hidden" name="logout" value="true">
                    <button class="submitRetour" type="submit">Retour</button>
                </form>
            </aside>
        </div>

    <?php } else { ;?>
        <div>
            <h1 class="titreM">Bonjour, vous etes connecté en tant qu'employé du garage V.PARROT</h1>
            <div class="priveContent">
                <p>Que voulez-vous modifier sur le site web du garage ?</p>
                <nav>
                    <ul class="priveLi">
                        <li><a href="vehicule.php">Véhicules</a></li>
                        <li><a href="valid_review.php">Avis</a></li>
                    </ul>
                </nav>
            </div>
            <aside>
                <form class="form" method="post" action="prive.php">
                    <input label="label" type="hidden" name="logout" value="true">
                    <button class="submitRetour" type="submit">Retour</button>
                </form>
            </aside>
        </div>
    <?php } ?>

    <?php
        if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: /server/connection.php");
        exit();
        }
    ?>
</body>
</html>