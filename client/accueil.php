<?php
session_start();
require('../server/bd_config.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../design/accueil.css">
		<link rel="stylesheet" type="text/css" href="../design/footerFormulaires.css">
		<link rel="stylesheet" type="text/css" href="../design/style.css"> 
		<link rel="icon" type="image/png" href="../image/favicon.png">
		<title>Amazing godasses Shop</title>
	</head>
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
					<img src="../image/air-force.jpg" alt="Nike Air Force" />
					<span>
						<p>Nike Air Force 1</p>
						<p>75 €</p>
					</span>
				</article>
				<article class="card">
					<img src="../image/air-jordan.jpg" alt="Nike Air Jordan" />
					<span>
						<p>Nike Air Jordan</p>
						<p>99 €</p>
					</span>
				</article>
				<article class="card">
					<img src="../image/adidas-nmd-blanc.jpg" alt="Adidas NMD" />
					<span>
						<p>Adidas NMD</p>
						<p>65 €</p>
					</span>
				</article>
				<article class="card">
					<img src="../image/air-force-1-brown.jpg" alt="Nike Air Force" />
					<span>
						<p>Nike Air Force 1</p>
						<p>77 €</p>
					</span>
				</article>
				<article class="card">
					<img src="../image/nike-blazer.jpg" alt="Nike Blazer" />
					<span>
						<p>Nike Blazer</p>
						<p>79,99 €</p>
					</span>
				</article>
				<article class="card">
					<img src="../image/yeezy-350.jpg" alt="Yeezy 350" />
					<span>
						<p>Yeezy 350</p>
						<p>120 €</p>
					</span>
				</article>
				<article class="card">
					<img src="../image/nike-air-max" alt="Nike Air Max" />
					<span>
						<p>Nike Air Max</p>
						<p>150 €</p>
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