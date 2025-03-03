<?php
session_start();
require_once '../db.php';

$error = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    try {
        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT id, firstname, lastname, password, role FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Stocker toutes les informations utilisateur dans la session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'email' => $user['email'],
                'role' => $user['role'] // Ajout du rôle
            ];

            // Redirection selon le rôle
            if ($user['role'] === 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            $error = "Identifiants incorrects. Veuillez réessayer.";
        }
    } catch (PDOException $e) {
        $error = "Erreur de connexion à la base de données.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="../css/registerr.css">
    <link rel="stylesheet" type="text/css" href="../css/buttonn.css">
</head>
<body>

    <div class="form">
        <h3 class="titre">Connexion</h3>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Votre email" required>
            <input type="password" name="password" placeholder="Votre mot de passe" required>
            <button type="submit" class="btn">Se connecter</button>
        </form>

        <a href="register.php" class="btn btnMenu">Créer un compte</a>
        <a href="javascript:history.back()" class="btn btnMenu">Retour</a>
    </div>
</body>
</html>
