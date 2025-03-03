<?php
session_start();
require_once '../db.php';

// Vérification si l'utilisateur est connecté et admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['error'] = "⛔ Accès refusé. Vous devez être administrateur.";
    header("Location: manage_users.php");
    exit();
}

// Vérifier si un ID utilisateur a été envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $user_id = $_POST['id'];

    // Empêcher la suppression de soi-même
    if ($user_id == $_SESSION['user']['id']) {
        $_SESSION['error'] = "❌ Vous ne pouvez pas vous supprimer vous-même.";
        header("Location: manage_users.php");
        exit();
    }

    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT id FROM users WHERE id = :id");
    $stmt->execute(['id' => $user_id]);

    if ($stmt->rowCount() > 0) {
        // Supprimer l'utilisateur
        $delete_stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $delete_stmt->execute(['id' => $user_id]);

        $_SESSION['success'] = "✅ Utilisateur supprimé avec succès.";
    } else {
        $_SESSION['error'] = "❌ L'utilisateur n'existe pas.";
    }
}

// Redirection vers la gestion des utilisateurs
header("Location: manage_users.php");
exit();
