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


	if (isset($_GET['action']) && $_GET['action']=='publier') {
		// Ajout/modif d'un article
		if (isset($_POST['titre']) && isset($_POST['contenu']) && isset($_POST['auteur'])) {

		$article = new News(array(
			'id' => $_POST['id'],
			'titre' => $_POST['titre'],
			'contenu' => $_POST['contenu'],
			'auteur' => $_POST['auteur']));

			
			// Si l'article la session contient un id, alors on est en train de modifier, si on ajoute
			if (isset($_SESSION['id']) && $_SESSION['id'] != 0) {
				// Modif article

				$manager->modifier($article);
				$_SESSION['id'] = 0; // on remet la variable à zéro pour indiquer que la modif est terminée
				$_SESSION['titre'] = '';
				$_SESSION['contenu'] = '';
				$_SESSION['auteur'] = '';
			}
			else
			{
				// ajout article
				$manager->ajouter($article);
			}
		}
	}//Modification d'un article
	elseif (isset($_GET['action']) && $_GET['action']=='modifier') {
		// Chargement de l'article en mémoire
		if (isset($_GET['id'])) {
			$article = $manager->afficher($_GET['id']);
			$_SESSION['id'] = $article->getId();
			$_SESSION['titre'] = $article->getTitre();
			$_SESSION['contenu'] = $article->getContenu();
			$_SESSION['auteur'] = $article->getAuteur();

			//var_dump($article);
		}
	}//Suppression d'un article
	elseif (isset($_GET['action']) && $_GET['action']=='supprimer')
	{
		if (isset($_GET['id'])) {
			$article = $manager->afficher($_GET['id']);
			$manager->supprimer($article);
		}
	}

	header('Location:admin.php');
?>