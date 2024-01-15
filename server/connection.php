

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/connection.css">
    <title>Formulaire de connection</title>
</head>
<body class="body">
    <h1 class="titrePrive">Bienvenue sur la page de connexion du Garage V.PARROT</h1>
    <div class="form">
        <form action="connection.php" class="formContent" method="POST">
            <label class="label" for="email">E-mail de connexion :</label>
            <input class="input" type="text" id="email" name="email" required>
            <label class="label" for="password">Mot de passe :</label>
            <input class="input" type="password" id="password" name="password" required>
            <input class="submit" type="submit" name="submit" value="Se connecter">
        </form>
    </div>
    <aside>
            <form class="form" method="post" action="connection.php">
                <input label="label" type="hidden" name="logout" value="true">
                <button class="submitRetour" type="submit">Retour</button>
            </form>
    </aside>

    <?php
        if (isset($_POST['logout'])) {
        header("Location: ../index.php");
        }
    ?>

    <?php
    
    include('bdd.php');
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql_user = "SELECT * FROM user WHERE email = :email";
                $stmt_user = $connect->prepare($sql_user);
                $stmt_user->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt_user->execute();
                $user = $stmt_user->fetch(PDO::FETCH_ASSOC);
    
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['admin'] = false;
                    $_SESSION['email'] = $email;
                    setcookie('email', $email, time() + 3600, '/');
                    header('location: /server/prive.php');
                    exit();
                } else {
                    $sql_admin = "SELECT * FROM admin WHERE email = :email";
                    $stmt_admin = $connect->prepare($sql_admin);
                    $stmt_admin->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt_admin->execute();
                    $admin = $stmt_admin->fetch(PDO::FETCH_ASSOC);
    
                    if ($admin && password_verify($password, $admin['password'])) {
                        $_SESSION['admin'] = true;
                        $_SESSION['email'] = $email;
                        setcookie('email', $email, time() + 3600, '/');
                        header('location: /server/prive.php');
                        exit();
    
                    } else {
                        echo '<script>alert("Erreur, email ou mot de passe incorrect");</script>';
                    }
                }
            }
        }
 ?>

</body>
</html>