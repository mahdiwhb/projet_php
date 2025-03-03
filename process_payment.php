<?php
// process_payment.php
// Attention : ceci est une simulation et ne doit pas être utilisé en production.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $cardName    = $_POST['card_name']    ?? '';
    $cardNumber  = $_POST['card_number']  ?? '';
    $expiryDate  = $_POST['expiry_date']  ?? '';
    $cvv         = $_POST['cvv']          ?? '';

    // Ici, on pourrait ajouter des vérifications (format, longueur, etc.)
    // et simuler le traitement du paiement.
    // En production, utilisez un service de paiement sécurisé (Stripe, PayPal, etc.)
    
    // Simulation : on considère que le paiement est validé
    $paymentStatus = true; // en simulation, toujours true

    if ($paymentStatus) {
        // Affichage de la confirmation
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Paiement Validé - Éclat d'Or</title>
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
        <main>
            <h2>Paiement Validé</h2>
            <p>Merci, votre commande a bien été prise en compte. (Simulation de paiement réussi.)</p>
        </main>
        <footer>
            <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
        </footer>
        </body>
        </html>
        <?php
    } else {
        // En cas d'erreur dans le traitement, rediriger ou afficher un message d'erreur
        echo "Une erreur est survenue lors du traitement du paiement.";
    }
} else {
    // Si la méthode n'est pas POST, rediriger vers la page d'accueil
    header("Location: index.php");
    exit;
}
?>
