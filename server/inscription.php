<?php
			/* FORMULAIRE D'INSCRIPTION */
session_start();

require('cookie.php');

if(isset($_SESSION['connect'])){
	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
	alert("Pas besoin de s'inscrire, vous êtes déjà connecté");
	
	header('location: index.php');

	exit();
}

if(isset($_POST["ok"])){

	foreach ($_POST as $k => $v) $$k = $v;
	
	if(!empty($name) && !empty($firstname) && !empty($birthdate) 
        && !empty($civilite) && !empty($email)
        && !empty($password) && !empty($password_two) 
		&& !empty($adresse)  && !empty($pays) ){

		require('bd.config.php');

		// VARIABLES
		$email 				= htmlspecialchars($email);
		$password 			= htmlspecialchars($password);
		$password_two		= htmlspecialchars($password_two);

		// PASSWORD = PASSWORD TWO
		if($password != $password_two){

			header('location: inscription.php?error=1&message=Vos mots de passe ne sont pas identiques.');
			exit();

		}

		// PASSWORD_TWO VERIFICATION STRONG
		function checkPassword($pwd) {
			if( strlen($pwd) < 8 ) {
				header('location: inscription.php?error=1&message=Mot de passe trop court.');
				exit();
			}

			if( !preg_match("#[0-9]+#", $pwd) ) {
				header('location: inscription.php?error=1&message=Mot de passe doit inclure au moins 1 chiffre.');
				exit();
			}

			if( !preg_match("#[a-z]+#", $pwd) ) {
				header('location: inscription.php?error=1&message=Mot de passe doit inclure au moins 1 minuscule.');
				exit();
			}

			if( !preg_match("#[A-Z]+#", $pwd) ) {
				header('location: inscription.php?error=1&message=Mot de passe doit inclure au moins 1 majuscule.');
				exit();
			}
				

			if( !preg_match("#\W+#", $pwd) ) {
				header('location: inscription.php?error=1&message=Mot de passe doit inclure au moins 1 caractère spécial.');
				exit();
			}
				
			
		}
		checkPassword($password);

		// ADRESSE EMAIL VALIDE
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

			header('location: inscription.php?error=1&message=Votre adresse email est invalide.');
			exit();

		}

		// EMAIL DEJA UTILISEE
		$req = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = ?");
		$req->execute(array($email));

		while($email_verification = $req->fetch()){

			if($email_verification['numberEmail'] != 0){

				header('location: inscription.php?error=1&message=Cette adresse email est déjà utilisée par un autre utilisateur.');
				exit();

			}

		}

		// HASH
		$secret = sha1($email).time();
		$secret = sha1($secret).time();

		// CHIFFRAGE DU MOT DE PASSE
		$password = "aq1".sha1($password."123")."25";

		// ENVOI

		$req = $db->prepare("INSERT INTO user(name, firstname, birthdate, sexe, address, email, pays, password, secret) VALUES(?,?,?, ?,?,?, ?,?,?)");
		$req->execute(array($name, $firstname, $birthdate, 
            $civilite, $adresse, $email,
            $pays, $password, $secret));

		header('location: inscription.php?success=1');
		exit();

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
	<link rel="icon" type="image/pngn" href="../img/favicon.png">
</head>
<body>

	<header>
      	<div id="brand">
         	<a href= "../index.php" ><img src="../img/logo.png" alt="LOGO" /></a>
      	</div>
   	</header>
	
	<section>
		<div id="login-body">
			<h1>Devenir membre</h1>
			<p>
				Devenez membre pour ne plus passer à côté des promotions, 
				des offres, des remises et des bons de réduction. 
			</p>

			<?php if(isset($_GET['error'])){

				if(isset($_GET['message'])) {

					echo'<div class="alert error">'.htmlspecialchars($_GET['message']).'</div>';

				}

			} else if(isset($_GET['success'])) {

				echo'<div class="alert success">Vous êtes désormais inscrit. <a href="../index.php">Connectez-vous</a>.</div>';

			} ?>

			<form method="post" action="inscription.php" >

			    <!--Civilité-->
			    <div class="input"><br>
					<label for="civilité" class="form-label">Civilité</label>
					<select name="civilite" class="form-select" id="civilite" required>
						<option value="">Choisir...</option>
						<option>Mr</option>
						<option>Mme</option>
					</select>
				</div>
				<!--Prénom-->
				<div class="input"><br>
					<label >Prénom</label>
              		<input name="firstname" type="text" placeholder="Prénom" required autofocus>
				</div>
				<!--Nom-->
				<div class="input">
					<label for="lastName" class="form-label">Nom de famille</label>
              		<input name="name" type="text" id="lastName" placeholder="Nom de famille"  required>
				</div>
				<!--Age-->
				<div class="input">
					<label for="date" class="form-label">Date de naissance </label>
              		<input name="birthdate" type="date" placeholder="Date de naissance">
			  	</div><br>

				<!--Adresse Principale-->
				<div class="input">
					<label for="address" class="form-label">Adresse</label>
					<input name="adresse" type="text" id="address" placeholder="1234 Main St" required>	
            	</div>
				
				
				<!--Number>
				<div class = "input">
					<label for="zip" class="form-label">Numéro</label>
					<input type="text" name="numero" placeholder="Votre numéro" required />
				</div-->

				<!--Pays-->
				<div class="input"><br>
					<label for="country" class="form-label">Pays</label>
              		<input name="pays" type="text" placeholder="Pays" required >
				</div>
		

				
				<!--Email-->
				<div class = "input">
					<label for="zip" class="form-label">Email</label>
					<input type="email" name="email" placeholder="Votre adresse email" required />
				</div>

				<!--Mot de passe-->
				<div class = "input">
					<i>
						<p>Votre mot de passe doit contenir au moins: <br/>
							<span id="minuscule" class="invalid">une minuscule</span> /
							<span id="majuscule" class="invalid">une majuscule</span> /
							<span id="chiffre" class="invalid">un chiffre</span> /
							<span id="special" class="invalid">un caractère spécial ($@!%*#/\&).</span> 
							<span id="longueur" class="invalid">Et faire au moins 8 caractères</span> 
						</p>
					</i>
					<label for="zip" class="form-label">Mot de passe</label>
					<input type="password" name="password" id = "pwd" placeholder="Mot de passe" required />
					<input type="checkbox" onclick = "Afficher()"> Afficher
						<br/><br/>
					<!--img src="img/close_eye.png" id = "eye" onClick="changer()" /-->
				</div>
			
				<!--Confirmation mot de passe-->
				<input type="password" name="password_two" id = "pwd2" placeholder="Retapez votre mot de passe" required />
				<input type="checkbox" onclick = "Afficher2()"> Afficher <br/><br/>

				<button type="submit" name = "ok" class>S'inscrire</button>
			</form>


			<p class="grey">Déjà membre ? <a href="../espace_commun/connexion.php">Connectez-vous</a>.</p>	<br>	
			<button style="width: 40%; padding: 5px; font-size: 0.85em" onclick="window.location.href='../espace_commun/accueilCommun.php';">Revenir à l'accueil</button>
		</div>
	</section>

	<?php /*include('../src/boutiqueFooter.php'); */?>
	<script src ="../js/script.js"> </script>
</body>
</html>

