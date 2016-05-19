<?php

class PersonnageManager
{
	private $_db;

	public function __construct($db)
  {
    $this->setDb($db);
  }
  

	public function ajouter(Personnage $perso)
	{
		$requete = $this->_db->prepare('INSERT INTO personnage(nom) VALUES(:nom)');
		$requete->bindValue(':nom', $perso->getNom());
		$requete->execute();

		$perso->hydrate([
			'id' => $this->_db->lastInsertId(),
			'degats' => 0,]
			);
	}

	public function modifier(Personnage $perso)
	{
		$requete = $this->_db->prepare('UPDATE Personnage SET nom=:nom, degats=:degats WHERE id=:id');
		$requete->bindValue(':nom', $perso->getNom());
		$requete->bindValue(':degats', $perso->getDegats(), PDO::PARAM_INT);
		$requete->bindValue(':id', $perso->getId(), PDO::PARAM_INT);
		$requete->execute();

	}

	public function supprimer(Personnage $perso)
	{
		$requete = $this->_db->prepare('DELETE FROM Personnage WHERE id=:id');
		$requete->bindValue(':id', $perso->getId(), PDO::PARAM_INT);
		$requete->execute();
	}

	public function selectionner($nom)
	{
		$requete = $this->_db->prepare('SELECT * FROM personnage WHERE nom=:nom');
		$requete->bindValue('nom', $nom);
		$requete->execute();

		return new Personnage($requete->fetch(PDO::FETCH_ASSOC)); // renvoi l'objet personnage sélectionné
	}

	public function nbPersonnages()
	{
		$result = $this->_db->query('SELECT COUNT(id) AS count FROM personnage');
		$data = $result->fetch();
		return $data['count'];
		//return $this->_db->query('SELECT COUNT(*) FROM personnage')->fetchColumn();
	}

	public function listerAdversaires($nom)
	{
		// on veut retourner un tableau avec tous les personnages autre que celui en paramètre
		// donc les adversaires de $nom
		$personnages = [];

		$requete = $this->_db->prepare('SELECT * FROM Personnage WHERE nom !=:nom');
		$requete->bindValue('nom', $nom);
		$requete->execute();
		
		while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
			$personnages[] = new Personnage($donnees);
		}

		return $personnages;

	}

	public function existe($nom)
	{
		$requete = $this->_db->prepare('SELECT COUNT(*) FROM personnage WHERE nom=:nom');
		$requete->bindValue('nom', $nom);
		$requete->execute();
		return $requete->fetchColumn();

	}

	public function setDb(PDO $db)
   {
    	$this->_db = $db;
   }
}

?>