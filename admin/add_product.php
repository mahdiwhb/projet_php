<?php
session_start();
require_once '../db.php';

// Vérification si l'utilisateur est connecté et admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['error'] = "⛔ Accès refusé. Vous devez être administrateur.";
    header("Location: manage_products.php");
    exit();
}

$error = "";
$success = "";

// Traitement du formulaire d'ajout de produit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $category = htmlspecialchars(trim($_POST['category']));
    $price = floatval($_POST['price']);
    $description = htmlspecialchars(trim($_POST['description']));
    
    // Vérification de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = basename($_FILES['image']['name']);
        $imagePath = "../images/" . $imageName;
        
        // Déplacement de l'image uploadée
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            try {
                // Insérer le produit dans la base de données
                $stmt = $pdo->prepare("INSERT INTO products (name, category, price, image, description) VALUES (:name, :category, :price, :image, :description)");
                $stmt->execute([
                    'name'        => $name,
                    'category'    => $category,
                    'price'       => $price,
                    'image'       => "images/" . $imageName, // Stocker le chemin de l'image
                    'description' => $description
                ]);

                $success = "✅ Produit ajouté avec succès.";
            } catch (Exception $e) {
                $error = "❌ Erreur lors de l'ajout du produit.";
            }
        } else {
            $error = "❌ Erreur lors du téléchargement de l'image.";
        }
    } else {
        $error = "❌ Veuillez ajouter une image.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="../css/manage_products.css">
</head>
<body>
    <div class="admin-dashboard">
        <h2>Ajouter un Produit</h2>
        <link rel="stylesheet" href="../css/add_product.css">

        <!-- Affichage des messages d'erreur ou succès -->
        <?php if (!empty($error)): ?>
            <p class="error-message"><?= $error; ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p class="success-message"><?= $success; ?></p>
        <?php endif; ?>

        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <label>Nom du produit :</label>
            <input type="text" name="name" required>

            <label>Catégorie :</label>
            <input type="text" name="category" required>

            <label>Prix :</label>
            <input type="number" name="price" step="0.01" required>

            <label>Image :</label>
            <input type="file" name="image" accept="image/*" required>

            <label>Description :</label>
            <textarea name="description" rows="4" required></textarea>

            <button type="submit" class="btn">Ajouter le produit</button>
        </form>

        <a href="manage_products.php" class="back-btn">Retour</a>
    </div>
</body>
</html>
