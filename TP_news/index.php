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

	<h1>Bienvenue dans mon site de news</h1>

	<a href="admin.php" class="btn btn-success"><span class="glyphicon glyphicon-arrow-right"></span> Administration</a>

	<h3>Voici les 5 derniers articles publiés : </h3>
	<br>

	<?php
			$mesNews = $manager->lister(5);
	?>
	<div class="row">
		<div class="col-sm-4">
          <div class="list-group">
          <?php foreach ($mesNews as $key => $value) { 
          	echo '<a href="article.php?id=' . $value->getId() . '" class="list-group-item active">'
          	?>
              <h4 class="list-group-item-heading"><?php echo $value->getTitre() ?></h4>
              <p class="list-group-item-text"><?php echo $value->getContenu() ?></p>
            </a>
            <?php } ?>
          </div>
        </div>
	</div>

</body>
</html>