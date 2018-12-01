<?php
 class Jeux
 {
  Private $_id;
  Private $_titre;
  Private $_temps;
  Private $_difficulte;
  Private $_multi;
  private $_possede;
  private $_idconsole;
  private $_fini;
  Private $_ps4;
  Private $_ps3;
  Private $_psvita;
  Private $_liens;
  Private $_comments;
  Private $_image;
  Private $_crosssav;
  Private $_crosstrophy;
  Private $_crossmulti;
  


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


  //accesseurs
  Public function id()
  {
  return $this->_id;
  }
  Public function titre()
  {
  return $this->_titre;
  }
  Public function temps()
  {
  return $this->_temps;
  }
  Public function difficulte()
  {
  return $this->_difficulte;
  }
  Public function multi()
  {
  return $this->_multi;
  }
  Public function ps4()
  {
  return $this->_ps4;
  }
  Public function ps3()
  {
  return $this->_ps3;
  }
  Public function psvita()
  {
  return $this->_psvita;
  }
  Public function liens()
  {
  return $this->_liens;
  }
  Public function fini()
  {
  return $this->_fini;
  }
  Public function possede()
  {
  return $this->_possede;
  }
   Public function comments()
  {
  return $this->_comments;
  }
  Public function image()
  {
  return $this->_image;
  }
  Public function crosssav()
  {
  return $this->_crosssav;
  }
  Public function crosstrophy()
  {
  return $this->_crosstrophy;
  }
  Public function crossmulti()
  {
  return $this->_crossmulti;
  }
  Public function idconsole()
  {
  return $this->_idconsole;
  }


//Mutateurs
  Public function setId($id)
  {
  if (empty($id))
   {
   trigger_error('Vous devez mettre un id', E_USER_WARNING);
   return;
   }
  $this->_id = $id;
  }
  Public function setTitre($titre)
  {
  if (empty($titre))
   {
   trigger_error('Vous devez mettre un titre', E_USER_WARNING);
   return;
   }
  $this->_titre = $titre;
  }
  Public function setTemps($temps)
  {
  if (!is_int($temps))
   //{
   //trigger_error('La durée doit être un nombre entier', E_USER_WARNING);
   //return;
   //}
   $this->_temps = $temps;
  }
  Public function setDifficulte($difficulte)
  {
   //if (!is_int($difficulte))
   //{
   //trigger_error('La difficulte doit être un nombre entier', E_USER_WARNING);
   //return;
   //}
   if ($difficulte > 10)
   {
   trigger_error('La difficulté doit être inferieur ou egal à 10', E_USER_WARNING);
   return;
   }
   $this->_difficulte = $difficulte;
  }
  Public function setMulti($multi)
  {
  return $this->_multi = $multi;
  }
  Public function setPs4($ps4)
  {
  return $this->_ps4 = $ps4;
  }
  Public function setPs3($ps3)
  {
  return $this->_ps3 = $ps3;
  }
  Public function setPsvita($psvita)
  {
  return $this->_psvita = $psvita;
  }
  Public function setLiens($liens)
  {
  return $this->_liens = $liens;
  }
  Public function setFini($fini)
  {
  return $this->_fini = $fini;
  }
  Public function setPossede($possede)
  {
  return $this->_possede = $possede;
  }
  Public function setComments($comment)
  {
  return $this->_comments = $comment;
  }
  Public function setImage($image)
  {
  return $this->_image = $image;
  }
  Public function setCrosssav($crosssav)
  {
  return $this->_crosssav = $crosssav;
  }
  Public function setCrosstrophy($crosstrophy)
  {
  return $this->_crosstrophy = $crosstrophy;
  }
  Public function setCrossmulti($crossmulti)
  {
  return $this->_crossmulti = $crossmulti;
  }
   Public function setIdconsole($idconsole)
  {
  return $this->_idconsole = $idconsole;
  }
  
}

 

