<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Poursuivre la commande - Éclat d'Or</title>
    <!-- Vous pouvez créer un fichier CSS dédié, par exemple css/style_checkout.css -->
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
    <h2>Poursuivre la commande</h2>
    <p>Veuillez saisir vos informations de paiement pour finaliser votre commande.</p>
    <form action="process_payment.php" method="post" class="checkout-form">
        <label for="card_name">Nom sur la carte</label>
        <input type="text" id="card_name" name="card_name" required>
        
        <label for="card_number">Numéro de carte</label>
        <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
        
        <label for="expiry_date">Date d'expiration</label>
        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/AA" required>
        
        <label for="cvv">CVV</label>
        <input type="text" id="cvv" name="cvv" placeholder="123" required>
        
        <button type="submit" class="btn">Confirmer l'achat</button>
    </form>
</main>

<footer>
    <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
</footer>
</body>
</html>
