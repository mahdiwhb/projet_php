<?php
session_start();
require_once 'db.php'; // Assurez-vous que db.php est dans le même dossier ou ajustez le chemin

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et nettoyage des données du formulaire d'inscription
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier que tous les champs sont remplis
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
        header("Location: connexion.php");
        exit;
    }

    // Vérifier que les mots de passe correspondent
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: connexion.php");
        exit;
    }

    // Vérifier si l'email existe déjà dans la table 'users'
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Cet email est déjà utilisé.";
        header("Location: connexion.php");
        exit;
    }

    // Hash du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insérer le nouvel utilisateur dans la table 'users'
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$firstname, $lastname, $email, $hashed_password])) {
        $_SESSION['success'] = "Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.";
        header("Location: connexion.php");
        exit;
    } else {
        $_SESSION['error'] = "Une erreur s'est produite lors de la création de votre compte.";
        header("Location: connexion.php");
        exit;
    }
}
?>
