<?php
$serveur = "localhost";
$login = "g1";
$mdp = "mdp01"; 

if(isset($_POST['id']) and isset($_POST['mdp']) ){
	$login=$_POST['id'];
	$mdp=$_POST['mdp'];
	$reg = '/^search([4-9]|[1-9][0-9])/';

  if(preg_match($reg,$login)){
    //connexion au serveur mysql (ici localhost)
    $connexion=mysqli_connect($serveur,$login,$mdp)
    or die("Connexion au serveur $serveur impossible pour $login");
    //nom de la base de donnees
    $bd="WebContest";
    //connexion à la base de donnees
    mysqli_select_db($connexion,$bd)
    or die("Impossible d'accéder à la base de données");

    $reqinsert="INSERT into personnel(id,mdp,status) VALUES(?,?,?)";
    $reqprepare=mysqli_prepare($connexion,$reqinsert);
    // insertion
  	mysqli_stmt_bind_param($reqprepare,'sss',$login,$mdp,$status);
  	mysqli_stmt_execute($reqprepare);
  }
	else{
    echo "Vous ne pouvez pas supprimer ce chercheur";
  }
}

mysqli_close($connexion);
?>
