
<?php
session_start();
// je recupère les données de .env pour la securité
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/');
$dotenv->load();

try {
    $connect = new PDO(
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}",
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD']
    );
   // echo "Connexion à la base de données réussie";
}
catch (PDOException $e) {
    echo "Erreur de connexion à la base de donnée". $e->getMessage();
}

?>
