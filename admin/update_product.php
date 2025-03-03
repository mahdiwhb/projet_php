<?php
session_start();
require_once '../db.php';

// Vérification si l'utilisateur est connecté et admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['error'] = "⛔ Accès refusé. Vous devez être administrateur.";
    header("Location: manage_products.php");
    exit();
}

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['price'])) {
    $product_id = $_POST['id'];
    $new_price = floatval($_POST['price']);

    // Vérifier que le prix est valide
    if ($new_price <= 0) {
        $_SESSION['error'] = "❌ Le prix doit être supérieur à 0.";
        header("Location: manage_products.php");
        exit();
    }

    // Vérifier si le produit existe
    $stmt = $pdo->prepare("SELECT id FROM products WHERE id = :id");
    $stmt->execute(['id' => $product_id]);

    if ($stmt->rowCount() > 0) {
        // Mettre à jour le prix
        $update_stmt = $pdo->prepare("UPDATE products SET price = :price WHERE id = :id");
        $update_stmt->execute([
            'price' => $new_price,
            'id' => $product_id
        ]);

        $_SESSION['success'] = "✅ Prix mis à jour avec succès.";
    } else {
        $_SESSION['error'] = "❌ Le produit n'existe pas.";
    }
}

// Redirection vers la gestion des produits
header("Location: manage_products.php");
exit();
