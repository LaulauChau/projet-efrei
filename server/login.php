<?php
		/* FORMULAIRE DE CONNEXION */

	session_start();

	require('cookie.php');

	if(!empty($_POST['email']) && !empty($_POST['password'])){

		require('bd_config.php');

		// VARIABLES
		$email 			= htmlspecialchars($_POST['email']);
		$password		= htmlspecialchars($_POST['password']);

		// ADRESSE EMAIL SYNTAXE
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			header('location: login.php?error=1&message=Votre-adresse-email-est-invalide.');
			exit();

		}

		// CHIFFRAGE DU MOT DE PASSE
		$password = "aq1".sha1($password."123")."25";

		// EMAIL DEJA UTILISE
		$req = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = ?");
		$req->execute(array($email));

		while($email_verification = $req->fetch()){
			if($email_verification['numberEmail'] != 1){
				header('location: login.php?error=1&message=Impossible-de-vous-authentifier-correctement.');
				exit();
			}
		}

		// CONNEXION
		$req = $db->prepare("SELECT * FROM user WHERE email = ?");
		$req->execute(array($email));

		while($user = $req->fetch()){

			if($password == $user['password']){

				$_SESSION['connect'] = 1;
				$_SESSION['email']   = $user['email'];

				if(isset($_POST['auto'])){
					setcookie('auth', $user['secret'], time() + 364*24*3600, '/', null, false, true);
				}

				header('location: ../client/accueil.php?success=1');
				exit();

			}
			else {

				header('location: login.php?error=1&Impossible-de-vous-authentifier-correctement.');
				exit();

			}

		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Stunning outfit Shop</title>
	<!--meta name="viewport" content="width=device-width"-->
	<link rel="stylesheet" type="text/css" href="../design/formulaires.css">
	<link rel="stylesheet" type="text/css" href="../design/footerFormulaires.css">
	<link rel="icon" type="image/pngn" href="../image/favicon.png">
</head>
<body>

<header>
      	<div id="brand">
         	<a href= "../index.php" ><img src="../image/logo.png" alt="LOGO" /></a>
      	</div>
   	</header>

     <section>
		<div id="login-body">
				
			<h1>Se connecter</h1>

				<?php if(isset($_GET['error'])) {

					if(isset($_GET['message'])) {
						echo'<div class="alert error">'.htmlspecialchars($_GET['message']).'</div>';
					}

				} ?>
				
			<form method="post" action="login.php">
				<input type="email" name="email" placeholder="Votre adresse email" required autofocus/>
				<input id = "pwd" type="password" name="password" placeholder="Mot de passe" required />
				<input type="checkbox" onclick = "Afficher()"> Afficher<br/><br/>

				<!--a href="recuperation.php" title="J'ai oubli?? mon mot de passe et je souhaite en mettre un nouveau">Mot de passe oubli??</a></label>
				<br/><br/-->
				<button type="submit">connexion</button>
				<label id="option"><input type="checkbox" name="auto" checked />Se souvenir de moi</label><br>
			</form>		

			<p class="grey">Pas encore membre? <a href="inscription.php">Devenir membre</a></p>	<br>	
			<button style="width: 40%; padding: 5px; font-size: 0.85em" onclick="window.location.href='../index.php';">Revenir ?? l'accueil</button>
					
		</div>
	</section>

	<?php
    include("../client/boutiqueFooter.php");
  ?> 
	<script src="../js/script.js"> </script>
</body>
</html>