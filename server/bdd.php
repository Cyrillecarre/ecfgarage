-- Active: 1704804554217@@127.0.0.1@3306

<?php
session_start();

$dbhost = $_ENV['DB_HOST'] = 'localhost';
$dbname = $_ENV['DB_NAME'] = 'garageparrot';
$dbuser = $_ENV['DB_USER'] = 'cyrille';
$dbpassword = $_ENV['DB_PASSWORD'] = 'cyrille1234';

require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/');
$dotenv->load();

try {
    $connect = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    echo "Connexion à la base de données réussie";
}
catch (PDOException $e) {
    echo "Erreur de connexion à la base de donnée". $e->getMessage();
}

?>