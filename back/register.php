<?php
session_start();
require_once '../db.php';

$error = "";
$success = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email && !empty($password)) {
        try {
            // Vérifier si l'email existe déjà
            $check_user = $pdo->prepare("SELECT id FROM users WHERE email = :email");
            $check_user->execute(['email' => $email]);

            if ($check_user->rowCount() > 0) {
                $error = "L'email est déjà utilisé !";
            } else {
                // Hachage sécurisé du mot de passe
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // Insertion des données
                $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) 
                                       VALUES (:firstname, :lastname, :email, :password)");
                $exec = $stmt->execute([
                    ":firstname" => $firstname,
                    ":lastname" => $lastname,
                    ":email" => $email,
                    ":password" => $hashed_password
                ]);

                if ($exec) {
                    $success = "Votre compte a été créé avec succès !";
                } else {
                    $error = "Erreur lors de l'inscription.";
                }
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion à la base de données.";
        }
    } else {
        $error = "Email invalide ou mot de passe vide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/Projet_PHP/css/registerr.css">
<link rel="stylesheet" href="/Projet_PHP/css/buttonn.css">

</head>
<body>

    <div class="form">
        <h3 class="titre">Inscription</h3>
        
        <?php if (!empty($error)): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="success-message"><?= htmlspecialchars($success) ?></p>
            <a href="login.php" class="btn">Se connecter</a>
        <?php else: ?>
            <form action="register.php" method="POST">
                <input type="text" name="firstname" placeholder="Prénom" required>
                <input type="text" name="lastname" placeholder="Nom" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit" class="btn">S'inscrire</button>
            </form>
            <a href="login.php" class="btn btnMenu">Déjà inscrit ? Se connecter</a>
            <a href="javascript:history.back()" class="btn btnMenu">Retour</a>
        <?php endif; ?>
    </div>
</body>
</html>
