<?php


  if(isset($_GET['id']) ){
  	$login=$_GET['id'];
  	$reg = '/^search([4-9]|[1-9][0-9])$/';

    if(preg_match($reg,$login)){

      $connexion = mysqli_connect("localhost","g1","mdp01")
      or die ("Tu es nul. Recommence.");
      // $connexion = mysqli_connect("localhost","g1","")
      // or die ("Tu es nul. Recommence.");

      $bd="WebContest";

      mysqli_select_db($connexion,$bd)
      or die ("Toujours pas.");

      $requete = $connexion -> prepare("DELETE FROM Personnel WHERE id LIKE ?");
      // suppressions
      $requete->bind_param("s",$id);
      $requete -> execute();
      $requete->close();
    }
  	else{
      echo "Vous ne pouvez pas supprimer ce chercheur";
    }
  }



	mysqli_close($connexion);
?>
