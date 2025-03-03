<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../back/login.php");
    exit();
}

$stmt = $conn->query("SELECT orders.id, users.name AS user_name, orders.total_price, orders.status 
                      FROM orders 
                      JOIN users ON orders.user_id = users.id
                      ORDER BY orders.created_at DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des commandes</title>
    <link rel="stylesheet" href="../css/manage_orders.css">
</head>
<body>
    <div class="container">
        <h2>Gestion des commandes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id']; ?></td>
                <td><?= htmlspecialchars($order['user_name']); ?></td>
                <td><?= $order['total_price']; ?>€</td>
                <td><?= $order['status']; ?></td>
                <td>
                    <!-- Pour modifier le statut de la commande -->
                    <form method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                        <select name="status">
                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : ''; ?>>En attente</option>
                            <option value="paid" <?= $order['status'] == 'paid' ? 'selected' : ''; ?>>Payé</option>
                            <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : ''; ?>>Expédié</option>
                        </select>
                        <button type="submit" name="update_status">Modifier</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="dashboard.php" class="back-btn">Retour au tableau de bord</a>
    </div>
</body>
</html>
