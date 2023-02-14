<?php

	if(isset($_COOKIE['auth']) && !isset($_SESSION['connect'])){

		// VARIABLE
		$secret = htmlspecialchars($_COOKIE['auth']);

		// VERIFICATION
		require('bd_config.php');

		$req = $db->prepare("SELECT count(*) as numberAccount FROM user WHERE secret = ?");
		$req->execute(array($secret));

		while($user = $req->fetch()){

			if($user['numberAccount'] == 1){

				$reqUser = $db->prepare("SELECT * from user WHERE secret = ?");
				$reqUser->execute(array($secret));

				while($userAccount = $reqUser->fetch()){

					$_SESSION['connect'] = 1;
					$_SESSION['email']   = $userAccount['email'];

				}

			}

		}

	}

	//ESPACE CLIENT
	/*if(isset($_SESSION['connect'])){

		require('../server/bd_config.php');

		$reqUser = $db->prepare("SELECT * from user WHERE email = ?");
		$reqUser->execute(array($_SESSION['email']));

		while($userAccount = $reqUser->fetch()){

			if($userAccount['blocked'] == 1) {
				header('location: logout.php');
				exit();
			}

		}

	}*/

	
?>