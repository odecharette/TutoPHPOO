<?php
		function charger_classes($classe)
	{
		require $classe . '.class.php';
	}

	spl_autoload_register('charger_classes');


	$bdd = new PDO('mysql:host=localhost;dbname=tpnews', 'root', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	$manager = new NewsManager($bdd);

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="style.css">
	<title>Mon site de news</title>
</head>
<body>

	<h1>Bienvenue dans l'administration du site</h1>

	<h3>Ici vous pouvez ajouter un article</h3>

	<br><br>
	<form>
		<p><label>Titre* : <input type="text" name="titre" required></label></p>
		<p><label>Contenu* : <TEXTAREA name="contenu" rows=8 COLS=100></TEXTAREA> </label></p>
		<p><label>Votre pseudo* : <input type="text" name="auteur" required></label></p>
		<p><input type="submit" name="publier" value="publier"></p>
	</form>

	<br><br>
	<h3>Ici vous pouvez modifier ou supprimer un article</h3>
	<br><br>

	<table width="80%" class="table table-striped">
		<tr>
			<th>Id</th>
			<th>Titre</th>
			<th>Contenu</th>
			<th>Auteur</th>
			<th>Créer le</th>
			<th>Modifié le</th>
			<th>Actions</th>
		</tr>
		<?php
		$allNews = $manager->lister(0);
		foreach ($allNews as $key => $value) {
			?><tr><?php
			echo '<td>' . $value->getId() . '</td>';
			echo '<td>' . $value->getTitre() . '</td>';
			echo '<td>' . $value->getContenu() . '</td>';
			echo '<td>' . $value->getAuteur() . '</td>';
			echo '<td>' . $value->getCreated_on() . '</td>';
			echo '<td>' . $value->getUpdated_on() . '</td>';
			echo '<td>' . '' . '</td>';
			?><tr><?php
		}
	?>
	</table>
	


</body>
</html>