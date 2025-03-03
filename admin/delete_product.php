<?php
session_start();
require_once '../db.php'; // Connexion à la base de données

// Vérification si l'utilisateur est administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['error'] = "⛔ Accès refusé. Vous devez être administrateur.";
    header("Location: manage_products.php");
    exit();
}

// Vérification si l'ID du produit est envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $productId = intval($_POST['id']);

    try {
        // Vérification si le produit existe
        $stmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // Suppression du produit de la base de données
            $deleteStmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
            $deleteStmt->execute(['id' => $productId]);

            // Suppression de l'image associée (optionnel)
            $imagePath = "../" . $product['image']; // Vérifie que le chemin est correct
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $_SESSION['success'] = "✅ Produit supprimé avec succès.";
        } else {
            $_SESSION['error'] = "❌ Produit introuvable.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "❌ Erreur lors de la suppression du produit.";
    }
}

header("Location: manage_products.php");
exit();
