<?php
		function charger_classes($classe)
	{
		require $classe . '.class.php';
	}

	spl_autoload_register('charger_classes');

	session_start();

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

	<?php
		if (isset($_GET['id'])) {
			$article = $manager->afficher($_GET['id']);
		?>
		<div class="row" id="article">
	        <div class="col-sm-4">
				<div class="panel panel-info">
		            <div class="panel-heading">
		              <h3 class="panel-title"><?php echo strtoupper($article->getTitre()) . ' - Publié par ' . $article->getAuteur() . ' le ' . $article->getCreated_on(); ?></h3>
		            </div>
		            <div class="panel-body">
		              <?php echo $article->getContenu();
		              if ($article->getUpdated_on() != '') {
		              	echo  '<br><p><i>Article modifié le ' . $article->getUpdated_on() . '</i></p>';
		              }
		               ?>
		            </div>
		          </div>
		    </div>
		</div>
			
	<?php	} 	?>

	<br><br>
	<a href="index.php" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Back home</a>

</body>
</html>