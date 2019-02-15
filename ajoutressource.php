<?php
$serveur = "localhost";
$login = "g1";
$mdp = "mdp01";

if(isset($_POST['id']) and isset($_POST['mdp']) )
{
	//$login=$_POST['id'];
	//$mdp=$_POST['mdp'];
  $login="search";
  $nom="search";
  $jour = date("y.m.d");
  //$id=$_POST['inputGroupSelect02'];
  $id="search";

  //connexion au serveur mysql (ici localhost)
  $connexion=mysqli_connect($serveur,$login,$mdp)
  or die("Connexion au serveur $serveur impossible pour $login");
  //nom de la base de donnees
  $bd="WebContest";
  //connexion à la base de donnees
  mysqli_select_db($connexion,$bd)
  or die("Impossible d'accéder à la base de données");

  $reqinsert="INSERT into ressource(id,mdp,jour,personne) VALUES(?,?,?,?)";
  $reqprepare=mysqli_prepare($connexion,$reqinsert);
  // insertion
	mysqli_stmt_bind_param($reqprepare,'ssss',$id,$nom,$jour,$login);
	mysqli_stmt_execute($reqprepare);
}

mysqli_close($connexion);
?>
