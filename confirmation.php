<?php
session_start();

// Vérification si l'utilisateur vient bien du paiement
if (!isset($_SESSION['success'])) {
    header("Location: index.php");
    exit();
}

// Récupération du message de succès
$successMessage = $_SESSION['success'];
unset($_SESSION['success']); // On supprime le message pour éviter qu'il ne s'affiche encore après refresh
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande Validée - Éclat d'Or</title>
    <link rel="stylesheet" href="css/style_checkout.css">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo">
            <img src="images/logo.png" alt="Logo Éclat d'Or">
        </div>
        <h1>Éclat d'Or</h1>
    </div>
</header>

<main>
    <div class="confirmation-container">
        <h2>🎉 Paiement Validé</h2>
        <p><?= htmlspecialchars($successMessage); ?></p>
        <p>Merci pour votre commande ! Un email de confirmation vous sera envoyé sous peu.</p>
        <a href="index.php" class="btn">Retour à l'accueil</a>
    </div>
</main>

<footer>
    <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
</footer>

</body>
</html>
