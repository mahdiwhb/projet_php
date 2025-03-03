<?php
session_start();
require_once '../db.php';

// Vérification si l'utilisateur est admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../back/login.php");
    exit();
}

// Récupérer les utilisateurs
$stmt = $pdo->query("SELECT id, firstname, lastname, email, created_at FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="../css/manage_userss.css">
</head>
<body>
    <div class="admin-dashboard">
        <h2>Gestion des utilisateurs</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']); ?></td>
                        <td><?= htmlspecialchars($user['firstname']); ?></td>
                        <td><?= htmlspecialchars($user['lastname']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td><?= htmlspecialchars($user['created_at']); ?></td>
                        <td>
                            <form action="delete_user.php" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                <button type="submit" class="delete-btn">Supprimer</button>
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
