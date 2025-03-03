<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Éclat d'Or - Accueil</title>
  <link rel="stylesheet" href="css/style_index.css">
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

<!-- SECTION HERO AVEC SLIDER -->
<section class="hero">
  <div class="slider-container">
    <!-- Première slide active au chargement -->
    <div class="slide active" style="background-image: url('images/slider1.jpg');"></div>
    <!-- Deuxième slide -->
    <div class="slide" style="background-image: url('images/slider2.jpg');"></div>
  </div>
  <div class="hero-content">
    <h2>Bienvenue chez Éclat d'Or</h2>
    <p>Découvrez nos bijoux élégants et raffinés.</p>
    <a href="produits.php" class="btn">Voir nos collections</a>
  </div>
</section>

  <!-- SECTION PRODUITS POPULAIRES -->
  <section class="produits-populaires">
    <h2>Produits Populaires</h2>
    <div class="produits-container">
      <div class="produit">
        <img src="images/colier en argent.jpg" alt="Produit 1">
        <h3>Collier en Argent</h3>
        <p class="prix">€19.99</p>
      </div>
      <div class="produit">
        <img src="images/braceletenor.jpg" alt="Produit 2">
        <h3>Bracelet en Or</h3>
        <p class="prix">€29.99</p>
      </div>
      <!-- Ajoute d'autres produits si nécessaire -->
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
  </footer>
  </script>
</body>
</html>
