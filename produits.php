<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$host = "localhost";
$dbname = "tp_web"; 
$username = "root"; 
$password = ""; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer toutes les catégories distinctes
$sql_categories = "SELECT DISTINCT category FROM products ORDER BY category";
$stmt = $pdo->prepare($sql_categories);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - Éclat d'Or</title>
    <link rel="stylesheet" href="css/style_produits.css">
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

<section class="produits">
    <h1>💎 Nos Produits</h1>
    <p class="description">Découvrez l’élégance intemporelle de la joaillerie française avec notre collection inspirée des grandes maisons de luxe.</p>

    <?php foreach ($categories as $cat): ?>
        <div class="titre">
            <center>
                <h4><?= htmlspecialchars($cat['category']) ?></h4>
            </center>
        </div>

        <section class="produits-container">
            <?php
            // Récupérer les produits de la catégorie actuelle
            $sql = "SELECT id, name, description, price, image FROM products WHERE category = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cat['category']]);
            $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($produits as $produit): ?>
                <div class="produit">
                    <div class="photos">
                        <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['name']) ?>">
                    </div>
                    <h3><?= htmlspecialchars($produit['name']) ?></h3>
                    <p class="description"><?= htmlspecialchars($produit['description']) ?></p>
                    <p class="price"><?= number_format($produit['price'], 2) ?> €</p>
                    <div class="add">
                        <a href="panier.php?ajout=<?= $produit['id'] ?>" class="btn">Ajouter au panier</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endforeach; ?>
</section>

<footer>
    <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
</footer>

</body>
</html>
