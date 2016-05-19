<?php

class News
{
	private $_id;
	private $_titre;
	private $_contenu;
	private $_auteur;
	private $_created_on;
	private $_updated_on;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

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

	public function getId() {	return $this->_id; }
	public function getTitre() {	return $this->_titre; }
	public function getContenu() {	return $this->_contenu; }
	public function getAuteur() {	return $this->_auteur; }
	public function getCreated_on() {	return $this->_created_on; }
	public function getUpdated_on() {	return $this->_updated_on; }

	public function setId($id){
		$id = (int)$id;
		if($id>0)
		{
			$this->_id = $id;
		}
	}

	public function setTitre($titre){
		if (is_string($titre)) {
			$this->_titre = substr($titre,0, 45);
		}
	}

	public function setContenu($contenu){
		if (is_string($contenu)) {
			$this->_contenu = $contenu;
		}
	}

	public function setAuteur($auteur){
		if (is_string($auteur)) {
			$this->_auteur = substr($auteur,0, 45);
		}
	}

	public function setCreated_on($date_create){
		$this->_created_on = $date_create;
	}

	public function setUpdated_on($date_update){
		$this->_updated_on = $date_update;
	}
 }

?>