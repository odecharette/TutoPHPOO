<?php

class Personnage
{
	private $_id;
	private $_nom;
	private $_degats = 0;

	const FORCE_COUP = 5;	// chaque coup donne 5 degats
	const CEST_MOI = 1;
	const PERSONNAGE_MORT = 2;
	const PERSONNAGE_FRAPPE = 3;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	// Les Getters
	public function getId() {	return $this->_id; }
	public function getNom() {	return $this->_nom; }
	public function getDegats() {	return $this->_degats; }

		// Les setters
	public function setId($id)
	{
		$id = (int)$id;
		if($id>0)
		{
			$this->_id = $id;
		}
	}

	public function setNom($nom)
	{
		if ($nom != '' && is_string($nom)) {
			$this->_nom = $nom;
		}
	}

	public function setDegats($degats)
	{
		$degats = (int)$degats;
		if ($degats>0) {
			$this->_degats = $degats;
		}
	}


	// Les fonctions d'actions

	public function frapper($perso)
	{
		

		// vérifier que je ne me frappe pas moi meme
		if ($perso->getId() == $this->getId()) {
			return seft::CEST_MOI;
		}
		else{
			return $perso->recevoirCoup();

		}
	}

	public function recevoirCoup()
	{
		// S'attribuer 5 coups de degats
		$coups = $this->getDegats() + self::FORCE_COUP;
		$this->setDegats($coups);
		// Vérifier la valeur de degat et si 100 alors mourrir
		$d = $this->getDegats();
		if($d>=100)
		{
			return self::PERSONNAGE_MORT;
		}

		return self::PERSONNAGE_FRAPPE;

	}


	// la fonction d'hydratation
	public function hydrate(array $data)
	{
		if (isset($data)) {
			foreach ($data as $key => $d) 	// data c'est le tableau en entrée / key c'est le nom de l'attribut / d c'est la valeur de l'attribut
			{
				$method = 'set' . ucfirst($key);
				if (method_exists($this, $method))
				{
					$this->$method($d);
				}
			}
		}
	}

}



?>