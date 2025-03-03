<?php
session_start();
require_once '../db.php';

// Vérification si l'utilisateur est connecté et admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['error'] = "⛔ Accès refusé. Vous devez être administrateur.";
    header("Location: manage_orders.php");
    exit();
}

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    $order_id = intval($_POST['id']);
    $new_status = htmlspecialchars($_POST['status']);

    // Vérification du statut valide
    $valid_statuses = ["En attente", "Payée", "Expédiée", "Annulée"];
    if (!in_array($new_status, $valid_statuses)) {
        $_SESSION['error'] = "❌ Statut invalide.";
        header("Location: manage_orders.php");
        exit();
    }

    try {
        // Mise à jour du statut de la commande
        $stmt = $pdo->prepare("UPDATE orders SET status = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $new_status,
            ':id' => $order_id
        ]);

        $_SESSION['success'] = "✅ Statut mis à jour avec succès.";
    } catch (Exception $e) {
        $_SESSION['error'] = "❌ Erreur SQL : " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "❌ Requête invalide.";
}

// Redirection vers la page de gestion des commandes
header("Location: manage_orders.php");
exit();
