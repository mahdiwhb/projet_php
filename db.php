<?php
// db.php
$host = 'localhost';
$dbname = 'tp_web'; // Remplacez par le nom réel de votre base de données
$username = 'root'; // Votre utilisateur MySQL
$password = '';     // Votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
