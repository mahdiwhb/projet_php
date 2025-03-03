<?php
session_start();
require_once '../db.php'; // Assure-toi que ce fichier existe et contient la connexion PDO

// Vérification si l'utilisateur est connecté et admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../back/login.php");
    exit();
}

// Vérification que la connexion à la base de données existe
if (!isset($pdo)) {
    die("❌ Erreur : Connexion à la base de données non trouvée.");
}

// Récupération des commandes
try {
    $stmt = $pdo->query("SELECT orders.id, users.firstname, users.lastname, orders.total, orders.status, orders.created_at 
                         FROM orders 
                         JOIN users ON orders.user_id = users.id 
                         ORDER BY orders.created_at DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("❌ Erreur SQL : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Commandes</title>
    <link rel="stylesheet" href="../css/manage_orderss.css">
</head>
<body>

<div class="admin-dashboard">
    <h2>📦 Gestion des Commandes</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total (€)</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['id']); ?></td>
                    <td><?= htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?></td>
                    <td><?= number_format($order['total'], 2); ?> €</td>
                    <td><?= htmlspecialchars($order['status']); ?></td>
                    <td><?= htmlspecialchars($order['created_at']); ?></td>
                    <td>
                        <form action="update_order.php" method="POST">
                            <input type="hidden" name="id" value="<?= $order['id']; ?>">
                            <select name="status">
                                <option value="En attente" <?= ($order['status'] == "En attente") ? "selected" : ""; ?>>En attente</option>
                                <option value="Payée" <?= ($order['status'] == "Payée") ? "selected" : ""; ?>>Payée</option>
                                <option value="Expédiée" <?= ($order['status'] == "Expédiée") ? "selected" : ""; ?>>Expédiée</option>
                                <option value="Annulée" <?= ($order['status'] == "Annulée") ? "selected" : ""; ?>>Annulée</option>
                            </select>
                            <button type="submit">Mettre à jour</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="back-btn">Retour au tableau de bord</a>
</div>

</body>
</html>
