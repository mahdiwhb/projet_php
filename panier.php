<?php
// Activer l'affichage des erreurs pour le débogage
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

// Ajout d'un produit au panier via l'URL (exemple : panier.php?ajout=2)
if (isset($_GET['ajout'])) {
    $productId = (int) $_GET['ajout'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $_SESSION['cart'][$productId] = [
                'id'       => $product['id'],
                'name'     => $product['name'],
                'price'    => $product['price'],
                'quantity' => 1,
                'image'    => $product['image']
            ];
        }
    }
    header("Location: panier.php");
    exit;
}

// Traitement du formulaire du panier pour mise à jour ou suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour des quantités
    if (isset($_POST['update'])) {
        foreach ($_POST['quantity'] as $productId => $quantity) {
            $quantity = (int)$quantity;
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$productId]);
            } else {
                $_SESSION['cart'][$productId]['quantity'] = $quantity;
            }
        }
    }
    // Suppression d'un produit
    if (isset($_POST['remove'])) {
        $removeId = $_POST['remove'];
        unset($_SESSION['cart'][$removeId]);
    }
    header("Location: panier.php");
    exit;
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier - Éclat d'Or</title>
    <link rel="stylesheet" href="css/style_panier.css">
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
    <h2>Votre Panier</h2>
    <?php if (empty($cart)): ?>
        <p class="empty-cart">Votre panier est vide.</p>
    <?php else: ?>
        <form action="panier.php" method="POST" class="cart-form">
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                        // Construction du chemin de l'image avec une valeur par défaut
                        $imgSrc = "images/" . htmlspecialchars($item['image'] ?? "default.jpg");
                    ?>
                    <tr>
                        <td class="product-info">
                            <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Produit') ?>" width="50">
                            <?= htmlspecialchars($item['name'] ?? 'Produit') ?>
                        </td>
                        <td><?= number_format($item['price'], 2) ?> €</td>
                        <td>
                            <input type="number" name="quantity[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1">
                        </td>
                        <td><?= number_format($subtotal, 2) ?> €</td>
                        <td>
                            <button type="submit" name="remove" value="<?= $item['id'] ?>" class="btn remove-btn">Supprimer</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-summary">
                <p class="total">Total : <strong><?= number_format($total, 2) ?> €</strong></p>
                <button type="submit" name="update" class="btn update-btn">Mettre à jour le panier</button>
            </div>
        </form>
        <!-- Bouton pour poursuivre la commande -->
        <div class="checkout-button" style="text-align: right; margin-top: 20px;">
            <a href="checkout.php" class="btn checkout-btn">Poursuivre la commande</a>
        </div>
    <?php endif; ?>
</main>
<footer>
    <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
</footer>
</body>
</html>
