<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$messageEnvoye = false;
$messageErreur = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et sécuriser les données du formulaire
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Vérifier que tous les champs sont remplis
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Ici, tu peux ajouter l'envoi d'email ou l'enregistrement en base de données
        $messageEnvoye = true;
    } else {
        $messageErreur = "❌ Tous les champs doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Éclat d'Or</title>
    <link rel="stylesheet" href="css/style_contact.css">
</head>
<body>

<?php session_start(); ?>
<header>
    <div class="header-container">
        <div class="logo">
            <img src="images/logo.png" alt="Logo Éclat d'Or">
        </div>
        <h1>Éclat d'Or</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="produits.php">Produits</a></li>
            <li><a href="offres.php">Offres</a></li>
            <li><a href="about.php">Qui sommes-nous ?</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="panier.php">Panier</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php" class="btn-auth">Se déconnecter</a></li>
            <?php else: ?>
                <li><a href="connexion.php" class="btn-auth">Inscription / Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>


    <section class="contact">
        <h1>📩 Contactez-nous</h1>
        <p>Une question ? Un conseil ? Remplissez le formulaire ci-dessous, nous vous répondrons rapidement.</p>

        <?php if ($messageEnvoye): ?>
            <p class="success-message">✅ Merci, <strong><?= htmlspecialchars($name) ?></strong> ! Votre message a été envoyé.</p>
        <?php elseif (!empty($messageErreur)): ?>
            <p class="error-message"><?= $messageErreur ?></p>
        <?php endif; ?>

        <form action="contact.php" method="POST">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message :</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Envoyer</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
    </footer>

</body>
</html>
