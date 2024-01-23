
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/userAdd.css">
    <title>Document</title>
</head>
<body class="body">
    <main class="userAdd">
        <h1>Ajouter un employé</h1>
        <div class="form">
            <form class="formContent" action="userAdd.php" method="post">
                <label class="label" for="email">E-mail :</label>
                <input class="input" type="text" id="email" name="email" required>
                <label class="label" for="password">Mot de passe :</label>
                <input class="input" type="password" id="password" name="password" required>
                <input class="submit" type="submit" name="submit" value="Ajouter un employé">
            </form>
        </div>
        <h1>Supprimer un employé</h1>
        <div class="form">
            <form class="formContent" action="userAdd.php" method="post">
                <label class="label" for="deleteEmail">E-mail :</label>
                <input class="input" type="text" id="deleteEmail" name="deleteEmail" required>
                <label class="label" for="deletePassword">Mot de passe :</label>
                <input class="input" type="password" id="deletePassword" name="deletePassword" required>
                <input class="submit" type="submit" name="submitDelete" value="Supprimer un employé">
            </form>
        </div>
        <h1>Ajouter un administrateur</h1>
        <div class="form">
            <form class="formContent" action="userAdd.php" method="post">
                <label class="label" for="emailAdmin">E-mail :</label>
                <input class="input" type="text" id="emailAdmin" name="emailAdmin" required>
                <label class="label" for="passwordAdmin">Mot de passe :</label>
                <input class="input" type="password" id="passwordAdmin" name="passwordAdmin" required>
                <input class="submit" type="submit" name="submitAdmin" value="Ajouter un administrateur">
            </form>
        </div>
        <h1>Supprimer un administrateur</h1>
        <div class="form">
            <form class="formContent" action="userAdd.php" method="post">
                <label class="label" for="deleteEmailAdmin">E-mail :</label>
                <input class="input" type="text" id="deleteEmailAdmin" name="deleteEmailAdmin" required>
                <label class="label" for="deletePasswordAdmin">Mot de passe :</label>
                <input class="input" type="password" id="deletePasswordAdmin" name="deletePasswordAdmin" required>
                <input class="submit" type="submit" name="submitDeleteAdmin" value="Supprimer l'administrateur">
            </form>
        </div>
        <aside>
        <form class="form" method="post" action="vehicule.php">
            <input label="label" type="hidden" name="logout" value="true">
            <button class="submitRetour" type="submit">Retour</button>
        </form>
        </aside>
    </main>
    <?php
    //ajout d'un employé//
    include('bdd.php');
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql_insert_user = "INSERT INTO user (email, password) 
            VALUES (:email, :password)";
            
            $stmt_insert_user = $connect->prepare($sql_insert_user);
            $query = $connect->prepare('INSERT INTO user (email, password) VALUES (:email, :password)');
            $stmt_insert_user->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt_insert_user->bindParam(':password', $passwordHash, PDO::PARAM_STR);

            
            if ($stmt_insert_user->execute()) {
                echo '<script>alert("Employé ajouté avec succès!");</script>';
            } else {
                echo '<script>alert("Erreur lors de l\'ajout!");</script>';
            }
        }
    }
    ?>

<?php
    //ajouter un admin//
    include('bdd.php');
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['emailAdmin']) && isset($_POST['passwordAdmin'])) {
            $emailAdmin = $_POST['emailAdmin'];
            $passwordAdmin = $_POST['passwordAdmin'];
            $passwordHashAdmin = password_hash($passwordAdmin, PASSWORD_DEFAULT);

            $sql_insert_admin = "INSERT INTO admin (email, password) 
            VALUES (:emailAdmin, :passwordAdmin)";
            
            $stmt_insert_admin = $connect->prepare($sql_insert_admin);
            $query = $connect->prepare('INSERT INTO admin (email, password) VALUES (:emailAdmin, :passwordAdmin)');
            $stmt_insert_admin->bindParam(':emailAdmin', $emailAdmin, PDO::PARAM_STR);
            $stmt_insert_admin->bindParam(':passwordAdmin', $passwordHashAdmin, PDO::PARAM_STR);

            
            if ($stmt_insert_admin->execute()) {
                echo '<script>alert("Administrateur ajouté avec succès!");</script>';
            } else {
                echo '<script>alert("Erreur lors de l\'ajout!");</script>';
            }
        }
    }
    ?>

    <?php
    //suppression d'un employé//
    if (isset($_POST['submitDelete'])) {
        $deleteEmail = $_POST['deleteEmail'];

        $sql_delete_user = "DELETE FROM user WHERE email = :email AND password = :password";
        $stmt_delete_user = $connect->prepare($sql_delete_user);
        $stmt_delete_user->bindParam(':email', $deleteEmail, PDO::PARAM_STR);
        $stmt_delete_user->bindParam(':password', $deletePassword, PDO::PARAM_STR);

        if ($stmt_delete_user->execute()) {
            echo '<script>alert("Employé supprimé avec succès!");</script>';
        } else {
            echo '<script>alert("Erreur lors de la suppression de l\'employé!");</script>';
        }
    }
    ?>

<?php
    //suppression admin//
    if (isset($_POST['submitDeleteAdmin'])) {
        $deleteEmailAdmin = $_POST['deleteEmailAdmin'];

        $sql_delete_admin = "DELETE FROM admin WHERE email = :emailAdmin";
        $stmt_delete_admin = $connect->prepare($sql_delete_admin);
        $stmt_delete_admin->bindParam(':emailAdmin', $deleteEmailAdmin, PDO::PARAM_STR);

        if ($stmt_delete_admin->execute()) {
            echo '<script>alert("Administrateur supprimé avec succès!");</script>';
        } else {
            echo '<script>alert("Erreur lors de la suppression de l\'administrateur!");</script>';
        }
    }
    ?>

    <?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /server/connection.php");
    exit();
}
?>
</body>
</html>