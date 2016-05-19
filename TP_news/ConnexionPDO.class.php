<?php

class ConnexionPDO
{
// NE MARCHE PAS !!!!!!!!!!!!!!


	
	public function __construct()
	{
		$bdd = new PDO('mysql:host=localhost;dbname=tpnews', 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		return $bdd;
	}
}

?>