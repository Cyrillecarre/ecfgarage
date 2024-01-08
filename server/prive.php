<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenue sur la page privé du Garage V.PARROT</h1>
    <?php if (isset($_SESSION['admin']) AND $_SESSION['admin'] == true) { ?>
        <h1>Bonjour MONSIEUR PARROT</h1>
        <p>Que voulez-vous modifier sur votre site web?</p>
        <nav>
            <ul>
                <li><a href="vehicule.php">Véhicules ?</a></li>
                <li><a href="user.php">Employés ?</a></li>
                <li><a href="schedule.php">Horaires ?</a></li>
            </ul>
        </nav>

    <?php } else { ?>
        <h1>Bonjour, vous etes connecté en tant qu'employé du garage V.PARROT</h1>
        <p>Que voulez-vous modifier sur le site web du garage ?</p>
        <nav>
            <ul>
                <li><a href="vehicule.php">Véhicules ?</a></li>
                <li><a href="schedule.php">Horaires ?</a></li>
            </ul>
        </nav>
    <?php } ?>
</body>
</html>