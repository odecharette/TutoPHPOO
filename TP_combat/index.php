<?php
	// Permet l'utilisation de la session
	session_start();
	//On initialise les variables de session, si elles n'existent pas encore
	if (!isset($_SESSION['nbPerso'])) {
		$_SESSION['nbPerso'] = 0;
	}
	//if (!isset($_SESSION['messages'])) {
		$_SESSION['messages'] = "";
	//}
	if (!isset($_SESSION['perso1'])) {
		$_SESSION['perso1'] = null;
	}
	if (!isset($_SESSION['listeAdversaires'])) {
		$_SESSION['listeAdversaires'] = [];
	}
	if (!isset($_SESSION['perso2'])) {
		$_SESSION['perso2'] = null;
	}
	//var_dump($_SESSION);

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Jeux de combat</title>
</head>
<body>

	<!-- 
	1/ afficher un formulaire pour créer ou choisir un personnage via son nom
	2/ Afficher le nom de personnages existants
	-->

	<h1>Bienvenue dans le jeu de combats !!!</h1>

	Pour le moment, il existe 
		<?php echo $_SESSION['nbPerso']; ?>
	personnage(s)
	<br><br>
	<form action="jeux.php" method="POST">
		<p><label>Nom du personnage : <input type="text" name="nom" maxlength="5" required></label></p>
		<input type="submit" name="creer" value="creer">
		<input type="submit" name="utiliser" value="utiliser">
	</form>

	<p>Messages : <?php echo $_SESSION['messages']; ?></p>


	<!--<p><a href="?sortir=OK">Se deconnecter</a></p>-->
	<?php 
		// if (isset($_GET['sortir'])) {
		// 	session_destroy();
		// }
	?>
	
</body>
</html>