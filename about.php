<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Qui sommes-nous ? - Éclat d'Or</title>
  <link rel="stylesheet" href="css/style_about.css">
</head>
<body>
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

  <section class="about">
    <h1>✨ Qui sommes-nous ?</h1>
    <p>
      Éclat d'Or est bien plus qu'une simple bijouterie : c'est un hommage à l'élégance intemporelle 
      et au savoir-faire artisanal de la joaillerie française. Depuis notre création, nous avons pour mission 
      d'offrir à nos clients des pièces d’exception, conçues avec passion et minutie.
    </p>
       
    <p>
      Chaque bijou que nous proposons incarne un équilibre parfait entre tradition et modernité, 
      entre raffinement et audace. Qu'il s'agisse d'une bague, d'un bracelet ou d'une parure complète, 
      nos créations sont pensées pour sublimer chaque instant de votre vie.
    </p>
    
    <h2>💎 Notre Engagement</h2>
    <p>
      Chez Éclat d'Or, nous sélectionnons avec soin des matériaux précieux pour créer des bijoux 
      d'une qualité exceptionnelle. Nos artisans joailliers mettent tout leur savoir-faire au service 
      de la perfection, en respectant les traditions de la haute joaillerie française.
    </p>

    <h2>🌟 Pourquoi choisir Éclat d'Or ?</h2>
    <ul>
      <li>🔹 Des bijoux haut de gamme conçus avec des matériaux précieux</li>
      <li>🔹 Une inspiration tirée des plus grandes maisons de joaillerie</li>
      <li>🔹 Un savoir-faire artisanal qui sublime chaque création</li>
      <li>🔹 Une expérience d'achat exclusive et personnalisée</li>
    </ul>

    <h2>📍 Nos Boutiques</h2>
    <p>
      Retrouvez nos collections dans nos boutiques à Paris, Lyon et Bordeaux, ou explorez nos 
      créations directement sur notre boutique en ligne.
    </p>

    <div class="back-to-home">
      <a href="index.php" class="btn">Retour à l'accueil</a>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Éclat d'Or - Tous droits réservés.</p>
  </footer>
</body>
</html>
