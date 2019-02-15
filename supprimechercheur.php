<?php
	echo "<h1>Modification de fiche client</h1>";
  //$connexion = mysqli_connect("localhost","g1","mdp01")
  //or die ("Tu es nul. Recommence.");
  $connexion = mysqli_connect("localhost","root","")
  or die ("Tu es nul. Recommence.");

  $bd="WebContest";

  mysqli_select_db($connexion,$bd)
  or die ("Toujours pas.");

  $chercheur = "search1";

  $requete = $connexion -> prepare("DELETE FROM Personnel WHERE id LIKE ?");
  $requete->bind_param("s",$chercheur);
  $requete -> execute();
  $requete->close();

	mysqli_close($connexion);
?>
