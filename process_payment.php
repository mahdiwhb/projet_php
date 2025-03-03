<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cardName    = $_POST['card_name']    ?? '';
    $cardNumber  = $_POST['card_number']  ?? '';
    $expiryDate  = $_POST['expiry_date']  ?? '';
    $cvv         = $_POST['cvv']          ?? '';
    
    $paymentStatus = true; 

    if ($paymentStatus) {

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
        echo "Une erreur est survenue lors du traitement du paiement.";
    }
} else {
    header("Location: index.php");
    exit;
}
?>
