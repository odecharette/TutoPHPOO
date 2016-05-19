<?php
	
	function charger_classes($classe)
	{
		require $classe . '.class.php';
	}

	spl_autoload_register('charger_classes');

	session_start();
	//var_dump($_SESSION);
	$perso = $_SESSION['perso1'];
	$listeAdversaires = $_SESSION['listeAdversaires'];
	

	$bdd = new PDO('mysql:host=localhost;dbname=combat', 'root', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.

	$manager = new PersonnageManager($bdd);

	if (isset($_POST['creer']) && isset($_POST['nom'])) {
		// Créer un personnage

		if ($manager->existe($_POST['nom'])) {
			$message = "L'utilisateur existe déjà";
			//header('Location: index.php');
		}
		else
		{
			$perso = new Personnage(['nom' => $_POST['nom']]);
			$manager->ajouter($perso);
			$message = "L'utilisateur a bien été crée";
		}
	}
	elseif (isset($_POST['utiliser']) && isset($_POST['nom'])) {
		
		if ($manager->existe($_POST['nom'])) {
			$perso = $manager->selectionner($_POST['nom']);
		}
		else
		{
			$message = "Le personnage demandé est introuvable";
		}
	}


		// on frappe l'adversaire 
		if (isset($_GET['frapper'])) {

			$manager = new PersonnageManager($bdd); // on doit recréer le manager car en changeant de page, il a été perdu + interdit de le stocker en session car il possède une connexion PDO

			// on charge perso2 avec l'adversaire sélectionné
			if ($manager->existe($_GET['frapper'])) {
				$perso2 = $manager->selectionner($_GET['frapper']);
				$message = "Adversaire sélectionné";

				// on le frappe
				$resultatCombat = $perso->frapper($perso2);
				// on envoi en base le nouvel état de perso2
				$manager->modifier($perso2);

				switch ($resultatCombat) {
					case 1:
						$message = "Tu t'es frappé toi même !!!!";
					break;
					case 2:
						$manager->supprimer($perso2);
						$message = "Tu as tué ton adversaire !";
					break;
					case 3:
						$message = "Adversaire blessé, essaye encore !";
					break;
					
					default:
						$message = "Ni 1 ni 2 ni 3";
					break;
				}
			}
			else
			{
				$message = "Votre adversaire est introuvable";
			}

		}

	// on met en session les infos nécessaires
	$_SESSION['nbPerso'] = $manager->nbPersonnages();
	$_SESSION['perso1'] = $perso;
	//$_SESSION['manager'] = $manager; // Interdit au stockage en Session car le manager contient une connexion à la BDD
	$_SESSION['messages'] = $message;
	$_SESSION['listeAdversaires'] = $manager->listerAdversaires($perso->getNom());
	 

	//var_dump($_SESSION);
	header('Location: jouer.php');

?>