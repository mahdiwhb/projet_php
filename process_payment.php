<?php
session_start();
require_once 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "⛔ Vous devez être connecté pour passer une commande.";
    header("Location: connexion.php");
    exit();
}

// Vérifier si le panier est vide
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['error'] = "❌ Votre panier est vide.";
    header("Location: panier.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$total = 0;

// Récupérer les informations du paiement
$cardName    = $_POST['card_name']    ?? '';
$cardNumber  = $_POST['card_number']  ?? '';
$expiryDate  = $_POST['expiry_date']  ?? '';
$cvv         = $_POST['cvv']          ?? '';

// Simulation de validation du paiement
$paymentStatus = true; // Met à `false` si tu veux simuler un échec

if ($paymentStatus) {
    try {
        // Calcul du total de la commande
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Insérer la commande dans `orders`
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status) VALUES (:user_id, :total, 'Payée')");
        $stmt->execute([
            ':user_id' => $user_id,
            ':total' => $total
        ]);

        // Récupérer l'ID de la dernière commande
        $order_id = $pdo->lastInsertId();

        // Insérer chaque produit dans `items`
        $stmt = $pdo->prepare("INSERT INTO items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
        foreach ($_SESSION['cart'] as $item) {
            $stmt->execute([
                ':order_id' => $order_id,
                ':product_id' => $item['id'],
                ':quantity' => $item['quantity'],
                ':price' => $item['price']
            ]);
        }

        // Vider le panier après validation
        unset($_SESSION['cart']);

        // Rediriger vers la confirmation
        $_SESSION['success'] = "✅ Votre commande a été passée avec succès !";
        header("Location: confirmation.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = "❌ Erreur lors de l'enregistrement de la commande.";
        header("Location: panier.php");
        exit();
    }
} else {
    $_SESSION['error'] = "❌ Erreur lors du paiement.";
    header("Location: panier.php");
    exit();
}
?>
