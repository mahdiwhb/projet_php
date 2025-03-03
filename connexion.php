<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Éclat d'Or</title>
    <link rel="stylesheet" href="css/style_connexion.css">
</head>
<body>
    <!-- HEADER -->
<header>
    <div class="header-container">
        <div class="logo">
            <img src="images/logo.png" alt="Logo Éclat d'Or">
        </div>
        <h1>Éclat d'Or</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="produits.php">Produits</a></li>
            <li><a href="offres.php">Offres</a></li>
            <li><a href="about.php">Qui sommes-nous ?</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="panier.php">Panier</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php" class="btn-auth">Se déconnecter</a></li>
            <?php else: ?>
                <li><a href="connexion.php" class="btn-auth">Inscription / Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

    <!-- MESSAGES DE SESSION -->
    <div class="messages">
        <?php if(isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        <?php if(isset($_SESSION['success'])): ?>
            <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
    </div>

    <!-- SECTION D'AUTHENTIFICATION -->
    <section class="auth-section">
        <!-- Formulaire de connexion -->
        <div class="login-container">
            <h2>Connexion</h2>
            <form action="login_process.php" method="POST">
                <label for="login-email">Adresse email :</label>
                <input type="email" id="login-email" name="email" required>

                <label for="login-password">Mot de passe :</label>
                <input type="password" id="login-password" name="password" required>

                <button type="submit">Se connecter</button>
            </form>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="registration-container">
            <h2>Inscription</h2>
            <form action="register_process.php" method="POST">
                <label for="reg-firstname">Prénom :</label>
                <input type="text" id="reg-firstname" name="firstname" required>

                <label for="reg-lastname">Nom :</label>
                <input type="text" id="reg-lastname" name="lastname" required>

                <label for="reg-email">Adresse email :</label>
                <input type="email" id="reg-email" name="email" required>

                <label for="reg-password">Mot de passe :</label>
                <input type="password" id="reg-password" name="password" required>

                <label for="reg-confirm-password">Confirmer le mot de passe :</label>
                <input type="password" id="reg-confirm-password" name="confirm_password" required>

                <button type="submit">Créer un compte</button>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
    </footer>
</body>
</html>
