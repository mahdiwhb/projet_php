<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
        header("Location: connexion.php");
        exit;
    }

    // Récupérer l'utilisateur correspondant à l'email dans la table 'users'
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier le mot de passe
    if ($user && password_verify($password, $user['password'])) {
        // Authentification réussie : enregistrer les informations en session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_firstname'] = $user['firstname'];
        $_SESSION['user_lastname'] = $user['lastname'];
        $_SESSION['success'] = "Vous êtes connecté avec succès.";
        header("Location: index.php"); // Redirection vers la page d'accueil par exemple
        exit;
    } else {
        $_SESSION['error'] = "Identifiants incorrects.";
        header("Location: connexion.php");
        exit;
    }
}
?>
