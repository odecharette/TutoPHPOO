<?php
	
	function charger_classes($classe)
	{
		require $classe . '.class.php';
	}

	spl_autoload_register('charger_classes');

	session_start(); // il faut ouvrir la session après l'appel des classes
	$perso1 = $_SESSION['perso1'];
	$listeAdversaires = $_SESSION['listeAdversaires'];
	$message = $_SESSION['messages'];
	
	//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h1> C'est parti pour le combat de la mort :) </h1>

	Votre personnage : <br>
		id : <?php echo $perso1->getId(); ?> <br>
		nom : <?php echo $perso1->getNom(); ?> <br>
		degats : <?php echo $perso1->getDegats(); ?> <br>

	<h2>Veuillez choisir un adversaire : </h2>


	<table width="150px">
		<tr>
			<th>Id</th>
			<th>Nom</th>
			<th>Degats</th>
		</tr>
		<?php
		foreach ($listeAdversaires as $key => $value) {
			?><tr><?php
			echo '<td>' . $value->getId() . '</td>';
			echo '<td><a href="jeux.php?frapper=' . $value->getNom() . '">' . $value->getNom() . '</a></td>';
			//echo '<td>' . $value->getNom() . '</td>';
			echo '<td>' . $value->getDegats() . '</td>';
			?><tr><?php
		}
	?>
	</table>


	

	<p><?php 
		$_SESSION['messages'] = $message;
		echo $_SESSION['messages'];  ?></p>

	<a href="index.php">Home Page</a>

</body>
</html>