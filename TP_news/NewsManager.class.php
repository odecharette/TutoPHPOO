<?php

class NewsManager
{
	private $_bdd;

	public function __construct($db)
  	{
    	$this->_bdd = $db;
  	}

	public function ajouter(News $news)
	{
		$requete = $this->_bdd->prepare('INSERT INTO news(titre, contenu, auteur) VALUES(:titre, :contenu, :auteur)');
		$requete->bindValue(':titre', $news->getTitre());
		$requete->bindValue(':contenu', $news->getContenu());
		$requete->bindValue(':auteur', $news->getAuteur());
		$requete->execute();

		$news->hydrate(['id' => $this->_bdd->lastInsertId()] );
		// ici il faudrait pouvoir hydrater aussi la dateTime de creation qui est automatiquement insérée en BDD
	}

	public function modifier($news)
	{
		$requete = $this->_bdd->prepare('UPDATE news SET titre=:titre, contenu=:contenu, auteur=:auteur WHERE id=:id');
		$requete->bindValue(':titre', $news->getTitre());
		$requete->bindValue(':contenu', $news->getContenu());
		$requete->bindValue(':auteur', $news->getAuteur());
		$requete->bindValue(':id', $news->getId());
		$requete->execute();

	}

	public function supprimer($news)
	{
		return $this->_bdd->query('DELETE FROM news WHERE id=' . $news->getId());

	}

	public function lister($nbNews)
	{
		$listeNews = [];

		if ((int)$nbNews>0) {
			// le paramètre est un entier positif, donc on limite le nb de résultat
			$requete = $this->_bdd->query('SELECT * FROM news ORDER BY created_on DESC LIMIT ' . $nbNews);
		}
		else{
			// on affiche tous les article
			$requete = $this->_bdd->query('SELECT * FROM news ORDER BY created_on DESC');
		}
		

		while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
			$listeNews[] = new News($donnees);
		}

		return $listeNews;
	}

	public function afficher($idNews)
	{
		$requete = $this->_bdd->prepare('SELECT id, titre, contenu, auteur, DATE_FORMAT(created_on, \'%d/%m/%Y\') AS created_on, DATE_FORMAT(updated_on, \'%d/%m/%Y\') AS updated_on FROM news WHERE id=:id');
		$requete->bindValue(':id', $idNews);
		$requete->execute();

		return new News($requete->fetch(PDO::FETCH_ASSOC)); // renvoi l'objet sélectionné
	}

}

?>