<?php
// Activer l'affichage des erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à MySQL
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tp_web';

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💎 Éclat d'Or</title>
    <link rel="stylesheet" type="text/css" href="/Projet_PHP/css/style.css"> 
    <link rel="stylesheet" type="text/css" href="/Projet_PHP/css/footer.css">
</head>
<body>

<div class="Conteneur">
    <div class="colonne1"></div>
    <div class="colonne2">
        <div class="container">
            <div class="header">
                <div class="logo">
                    <a href="#"><img class="imgLogo" src="/Projet_PHP/images/logo.png"></a>
                </div>
                <div class="navbar">
                    <ul>
                        <li class="active"><a href="/Projet_PHP/index.php">Accueil</a></li>
                        <li><a href="/Projet_PHP/html/products.html">Produits</a></li>   
                        <li><a href="/Projet_PHP/html/offres.html">Offres</a></li>
                        <li><a href="/Projet_PHP/html/about.html">Qui sommes-nous ?</a></li>
                        <li><a href="/Projet_PHP/html/contacts.html">Contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- SLIDER -->
        <div class="bodySlider">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img class="imgSlider" src="/Projet_PHP/images/slider/jpg/slider1.jpg" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img class="imgSlider" src="/Projet_PHP/images/slider/jpg/slider2.jpg" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img class="imgSlider" src="/Projet_PHP/images/slider/jpg/slider3.jpg" style="width:100%">
                </div>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>

        <!-- NOS ENGAGEMENTS -->
        <section class="engagements">
            <h2>✨ Nos engagements ✨</h2>
            <div class="engagements-container">
                <div class="engagement">
                    <img src="/Projet_PHP/images/icons/quality.svg" alt="Qualité">
                    <h3>Qualité premium</h3>
                    <p>Des bijoux en or et argent 925, conçus avec passion.</p>
                </div>
                <div class="engagement">
                    <img src="/Projet_PHP/images/icons/shipping.svg" alt="Livraison">
                    <h3>Livraison rapide</h3>
                    <p>Expédition sécurisée en 24/48h partout en France.</p>
                </div>
                <div class="engagement">
                    <img src="/Projet_PHP/images/icons/secure.svg" alt="Paiement sécurisé">
                    <h3>Paiement sécurisé</h3>
                    <p>Transactions cryptées pour un achat en toute confiance.</p>
                </div>
            </div>
        </section>

        <!-- CATÉGORIES -->
        <section class="categories">
            <h2>Nos Collections</h2>
            <div class="categories-container">
                <div class="categorie">
                    <img src="/Projet_PHP/images/categories/bague.jpg" alt="Bagues">
                    <h3>Bagues</h3>
                </div>
                <div class="categorie">
                    <img src="/Projet_PHP/images/categories/bracelet.jpg" alt="Bracelets">
                    <h3>Bracelets</h3>
                </div>
                <div class="categorie">
                    <img src="/Projet_PHP/images/categories/collier.jpg" alt="Colliers">
                    <h3>Colliers</h3>
                </div>
            </div>
        </section>

        <!-- AVIS CLIENTS -->
        <section class="avis">
            <h2>💬 Nos clients en parlent 💬</h2>
            <div class="avis-container">
                <div class="avis-item">
                    <p>⭐⭐⭐⭐⭐ "Magnifiques bijoux, livraison rapide et service client au top !"</p>
                    <span>- Sophie L.</span>
                </div>
                <div class="avis-item">
                    <p>⭐⭐⭐⭐⭐ "J'ai offert une bague, elle est encore plus belle en vrai !"</p>
                    <span>- Thomas D.</span>
                </div>
                <div class="avis-item">
                    <p>⭐⭐⭐⭐⭐ "Enfin une boutique de bijoux qui propose des modèles raffinés."</p>
                    <span>- Camille M.</span>
                </div>
            </div>
        </section>

        <!-- BOUTON COLLECTION -->
        <div class="btn-center">
            <a href="/Projet_PHP/html/products.html" class="btn btn-big">Découvrir notre collection</a>
        </div>

        <footer class="footer-distributed">
			<div class="footer-left">
			
						 <h3>Éclat <span> D'or</span></h3>

			<p class="footer-links">
				<a href="http://localhost/projet_PHP/index.php">Acceuil</a>
				.
				<a href="http://localhost/projet_PHP/html/products.html">Produits</a>
				.
				<a href="http://localhost/projet_PHP/html/about.html">Qui sommes-nous ? </a>
				.
				<a href="http://localhost/projet_PHP/html/contacts.html">Contact</a>
			</p>

			<p class="footer-company-name">Copyrights @2025</p>

			<div class="footer-icons">

			<a href="https://facebook.com" target="_blank"><img class="imgHeader" src="../images/icons/facebook_icon.svg"></a>
				<a href="https://twitter.com" target="_blank"><img class="imgHeader" src="../images/icons/twitter_icon.svg"></a>
				<a href="https://instagram.com" target="_blank"><img class="imgHeader" src="../images/icons/instagram_icon.svg"></a>
				<a href="https://linkedin.com" target="_blank"><img class="imgHeader" src="../images/icons/linkedin_icon.svg"></a>


			</div>

		</div>

		<div class="footer-right">

			<p>Contact</p>

			<form action="#" method="post">

				<input type="text" name="email" placeholder="Email">
				<textarea name="message" placeholder="Message"></textarea>
				<button>envoyer</button>

			</form>

		</div>

	</footer>
	</div>
	
	<div class="colonnes colonne3"></div>
</div>

<script>
// JavaScript pour le slider
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");

    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}

    for (var i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }

    slides[slideIndex-1].style.display = "block";  
}
</script>

</body>
</html>
