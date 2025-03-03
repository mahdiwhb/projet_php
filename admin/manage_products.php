<?php
session_start();
require_once '../db.php'; // Utilisation du fichier de connexion existant

// Vérification si l'utilisateur est admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../back/login.php");
    exit();
}
$query = $pdo->query("SELECT * FROM products");
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <link rel="stylesheet" href="../css/manage_productss.css">
</head>
<body>
    <div class="admin-dashboard">
        <!-- Boutons Retour et Ajouter un produit -->
        <div class="top-bar">
            <a href="dashboard.php" class="back-btn">Retour au tableau de bord</a>
            <a href="add_product.php" class="add-btn">Ajouter un produit</a>
        </div>

        <h2>Liste des produits</h2>
        
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="product-image">
                    <h3><?= htmlspecialchars($product['name']); ?></h3>
                    <p>Prix : <strong><?= htmlspecialchars($product['price']); ?>€</strong></p>

                    <!-- Formulaire de modification du prix -->
                    <form action="update_product.php" method="POST">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                        <input type="number" name="price" value="<?= htmlspecialchars($product['price']); ?>" step="0.01" required>
                        <button type="submit" name="update" class="update-btn">Modifier le prix</button>
                    </form>

                    <!-- Formulaire de suppression du produit -->
                    <form action="delete_product.php" method="POST">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                        <button type="submit" name="delete" class="delete-btn">Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
