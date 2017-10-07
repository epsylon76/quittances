<?php


  $maxsize = 88808864;
  $avertissement="";

  if ($_FILES['tampon']['error'] > 0)
  {
    echo "erreur php file: ".$_FILES['tampon']['error']."<br>";
  }

  if ($_FILES['tampon']['size'] > $maxsize)
  {
  $avertissement="ATTENTION Fichier image trop gros";
  }
  $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
  echo $_FILES['tampon']['name'];
  //1. strrchr renvoie l'extension avec le point (« . »).
  //2. substr(chaine,1) ignore le premier caractère de chaine.
  //3. strtolower met l'extension en minuscules.
  $extension_upload = strtolower(  substr(  strrchr($_FILES['tampon']['name'], '.')  ,1)  );
  if(!in_array($extension_upload,$extensions_valides))
  {$avertissement="ATTENTION format d'image non valide";}



  //créer le repertoir s'il n'existe pas
  if(!is_dir("../assets/img/{$sid}/"))
  {
    mkdir("../assets/img/{$sid}/");
  }
  $nom = "../assets/img/{$sid}/{$_FILES['tampon']['name']}";

  $resultat = move_uploaded_file($_FILES['tampon']['tmp_name'],$nom);
