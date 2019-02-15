<?php
  //$connexion = mysqli_connect("localhost","g1","mdp01")
  //or die ("Tu es nul. Recommence.");
  $connexion = mysqli_connect("localhost","root","")
  or die ("Tu es nul. Recommence.");

  $bd="WebContest";

  mysqli_select_db($connexion,$bd)
  or die ("Toujours pas.");

  $requete = $connexion -> prepare("DELETE FROM Personnel WHERE id LIKE ?");

  if(isset($_POST['id']) ){
  	$login=$_POST['id'];
  	$reg = '/^search[4-9]|[1-9][0-9])/';

    if(preg_match($reg,$login)){
      // suppressions
      $requete->bind_param("s",$id);
      $requete -> execute();
    }
  	else{
      echo "Vous ne pouvez pas supprimer ce chercheur";
    }
  }

  $requete->close();

	mysqli_close($connexion);
?>
