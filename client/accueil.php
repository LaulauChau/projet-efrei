<?php
session_start();
require('../server/bd_config.php');
?>

<!DOCTYPE html>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../design/accueil.css">
    <link rel="stylesheet" type="text/css" href="../design/footerFormulaires.css">
	<link rel="stylesheet" type="text/css" href="../design/style.css"> 
	<link rel="icon" type="image/png" href="../image/favicon.png">
	<title>Amazing godasses Shop</title>
	<body>
		<header>
			<?php
			if(isset($_SESSION['connect'])) {
                if(isset($_GET['success'])){   
					echo'<div class="alert success">Vous êtes maintenant connecté.</div>';
				?>
                    <button class="glow-on-hover" onclick="window.location.href='../server/logout.php';">Se déconnecter</button>

            <?php }} 
                else { ?> 
					<div id="brand">
						<a href="accueil.php" ><img src="../image/logo.png" alt="LOGO" /></a>
						<button class="glow-on-hover" onclick="window.location.href='../server/login.php';">Se connecter </button> 
					</div>        
            <?php }?>

			<h1 class= "h1 text-gradiant" >Amazing godasses Shop !</h1> <br>   
				
				<!-- image déroulante -->
				<div id = "caroussel">
					<div class="images">
						<img src="../image/sport_header.jpg">
						<img src="../image/Nike_header.jpg">
						<img src="../image/adidas_header.jpg">
						<img src="../image/Jordan_header.png">
					</div>
				</div>
				
		</header>

		<main>
			<section class="cards">
				<article class="card">
					<img src="../image/polaire-nike.png" alt="Polaire Nike Sportswear Club" />
					<span>
						<p>Polaire Nike Sportswear Club</p>
						<p>66 €</p>
					</span>
				</article>
				<article class="card">
					<img src="../image/sweat-tnf.jpg" alt="4566SWTNORTHFACE" />
					<span>
						<p>Sweat The North Face</p>
						<p>72 €</p>
					</span>
				</article>
				<article class="card">
					<img src="../image/sweat-tnf-2.jpg" alt="HOMMEWIHTE5555THN" />
					<span>
						<p>Hoodie The North Face</p>
						<p>42 €</p>
					</span>
				</article>
			</section>
		</main>

	<!-- Bouton RETOUR EN HAUT DE PAGE -->
	<div id="scroll_to_top">
			<a href="#top"><img src="../image/to_top.png" title="Retourner en haut" /></a>
		</div>

			<!-- CONTACT -->
			<section >
				<?php require("boutiqueFooter.php"); ?>
			</section>
	</body>
</html>