<?php

//************************** 
//on attrape les erreurs et on affiche un msg personnalisé
//************************** 

function additionner($a, $b)
{
  if (!is_numeric($a) || !is_numeric($b))
  {
    throw new Exception('Les deux paramètres doivent être des nombres');
  }
  
  return $a + $b;
}

try // Nous allons essayer d'effectuer les instructions situées dans ce bloc.
{
  echo additionner(12, 3), '<br />';
  echo additionner('azerty', 54), '<br />';
  echo additionner(4, 8);
}

catch (Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
{
  echo 'Une exception a été lancée. Message d\'erreur : ' . $e->getMessage() 
  		. '<br>Code : ' . $e->getCode()
  		. '<br>Fichier source : ' . $e->getFile()
  		. '<br>Ligne : ' . $e->getLine()
  		. '<br>';
}

echo '<p>Fin du script 1</p>'; // Ce message s'affiche, ça prouve bien que le script est exécuté jusqu'au bout.

//************************** 
//on attrape les erreurs et on les rend silencieuses
//**************************

try // Nous allons essayer d'effectuer les instructions situées dans ce bloc.
{
  echo additionner(12, 3), '<br />';
  echo additionner('azerty', 54), '<br />';
  echo additionner(4, 8);
}

catch (Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
{
}

echo '<p>Fin du script 2</p>'; 

//************************** 
// Exception pour PDO (connexion à la BDD) / on utilise un type d'exception prédéfinie
//**************************
try
{
  $db = new PDO('mysql:host=localhost;dbname=tests', 'root', ''); // Tentative de connexion.
  echo 'Connexion réussie !'; // Si la connexion a réussi, alors cette instruction sera exécutée.
}
catch (PDOException $e) // On attrape les exceptions PDOException.
{
  echo 'La connexion a échoué.<br />';
  echo 'Informations : [' . $e->getCode(), '] ' . $e->getMessage() . '<br><br>'; // On affiche le n° de l'erreur ainsi que le message.
}




//************************** 
// On force une erreur sans l'attraper
// Le script est arrêté brutalement, sans aller au bout
//**************************
function additionnerBis($a, $b)
{
  if (!is_numeric($a) || !is_numeric($b))
  {
    throw new Exception('Les deux paramètres doivent être des nombres');
  }
  
  return $a + $b;
}

  echo additionnerBis(12, 3), '<br />';
  echo additionnerBis('azerty', 54), '<br />';
  echo additionnerBis(4, 8);

echo '<p>Fin du script 3</p>'; 



?>