<?php
session_start();
require_once 'db.php';

// Vérification si l'utilisateur est connecté
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

// Récupération des informations de paiement
$card_name = htmlspecialchars($_POST['card_name']);
$card_number = htmlspecialchars($_POST['card_number']);
$expiry_date = htmlspecialchars($_POST['expiry_date']);
$cvv = htmlspecialchars($_POST['cvv']);

// Vérification basique des informations de carte
if (empty($card_name) || empty($card_number) || empty($expiry_date) || empty($cvv)) {
    $_SESSION['error'] = "❌ Veuillez remplir toutes les informations de paiement.";
    header("Location: checkout.php");
    exit();
}

// Simuler un paiement valide (dans un vrai projet, intégrer une API)
if (strlen($card_number) != 16 || !is_numeric($card_number) || strlen($cvv) != 3) {
    $_SESSION['error'] = "❌ Informations de carte invalides.";
    header("Location: checkout.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$total = 0;

// Calculer le total de la commande
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

try {
    // Démarrer une transaction pour sécuriser la commande
    $pdo->beginTransaction();

    // Insérer la commande dans `orders`
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status) VALUES (:user_id, :total, 'Payée')");
    $stmt->execute([
        'user_id' => $user_id,
        'total'   => $total
    ]);

    // Récupérer l'ID de la commande créée
    $order_id = $pdo->lastInsertId();

    // Insérer chaque produit commandé dans `items`
    $stmt = $pdo->prepare("INSERT INTO items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
    
    foreach ($_SESSION['cart'] as $item) {
        $stmt->execute([
            'order_id'   => $order_id,
            'product_id' => $item['id'],
            'quantity'   => $item['quantity'],
            'price'      => $item['price']
        ]);
    }

    // Vider le panier après la commande
    unset($_SESSION['cart']);

    // Valider la transaction
    $pdo->commit();

    $_SESSION['success'] = "✅ Paiement réussi ! Votre commande a été enregistrée.";
    header("Location: confirmation.php");
    exit();

} catch (Exception $e) {
    // Annuler la transaction en cas d'erreur
    $pdo->rollBack();
    $_SESSION['error'] = "❌ Une erreur est survenue lors de la commande.";
    header("Location: checkout.php");
    exit();
}
?>
