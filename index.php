<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$host = "localhost";
$dbname = "tp_web"; // Nom de la base de données
$username = "root"; // Par défaut sur WAMP
$password = ""; // Mot de passe vide sur WAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des produits depuis la table `product`
$sql = "SELECT id, name, description, price, image FROM products LIMIT 3"; // Sélectionne 3 produits
$stmt = $pdo->prepare($sql);
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Éclat d'Or</title>
    <link rel="stylesheet" href="css/style_index.css">
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

    <section class="hero">
        <h2>Bienvenue chez Éclat d'Or</h2>
        <p>Découvrez nos bijoux élégants et raffinés.</p>
        <a href="produits.php" class="btn">Voir nos collections</a>
    </section>

    <section class="produits-populaires">
        <h2>Nos Meilleurs Bijoux</h2>
        <div class="produits-container">
            <?php foreach ($produits as $produit): ?>
                <div class="produits">
                <img src="/images/?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['name']) ?>">
                <h3><?= htmlspecialchars($produit['name']) ?></h3>
                    <p><?= htmlspecialchars($produit['description']) ?></p>
                    <p class="prix"><?= number_format($produit['price'], 2) ?> €</p>
                    <a href="panier.php?ajout=<?= $produit['id'] ?>" class="btn">Ajouter au panier</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
    </footer>

</body>
</html>
