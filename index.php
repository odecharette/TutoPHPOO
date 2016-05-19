<?php
//////////////////////////////// Création d'un objet personnage depuis la BDD

include_once('Personnage.class.php')

// On admet que $db est un objet PDO.
$request = $db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages');
    
while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.
{
  // On passe les données (stockées dans un tableau) concernant le personnage au constructeur de la classe.
  // On admet que le constructeur de la classe appelle chaque setter pour assigner les valeurs qu'on lui a données aux attributs correspondants.
  $perso = new Personnage($donnees);
        
  echo $perso->getNom(), ' a ', $perso->forcePerso(), ' de force, ', $perso->degats(), ' de dégâts, ', $perso->experience(), ' d\'expérience et est au niveau ', $perso->niveau();
}



/////////////////////////////////// fonction hydrate standard à réutiliser

public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}

// Exemple : je lit le contenu d'un objet Personnage dans la table, et avec le tableau reçu en return, j'hydrate un objet Personnage
// donc j'affecte chaque valeur de la table à l'attribut de l'objet
////////////////////////////////////