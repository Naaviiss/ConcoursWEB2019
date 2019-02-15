<?php



$serveur = "localhost";
$login = "g1";
$mdp = "mdp01";

//connexion au serveur mysql (ici localhost)
$connexion=mysqli_connect($serveur,$login,$mdp)
or die("Connexion au serveur $serveur impossible pour $login");

//nom de la base de donnees
$bd="WebContest";

//connexion à la base de donnees
mysqli_select_db($connexion,$bd)
or die("Impossible d'acceder à la base de données");

$reqinsert="INSERT into personnel(id,mdp,status) VALUES(?,?,?)";

$reqprepare=mysqli_prepare($connexion,$reqinsert);

//liaison des parametres :
if(isset($_POST['connection']))
{
	preg_match('/(1)(2)(3)/', $_POST['id'], $matches );
	var_dump($matches);
}


if( $_POST['status'] > 4)
	echo "test";


if(isset($_POST['id']) and isset($_POST['mdp']) ){
	$login=$_POST['id'];
	$mdp=$_POST['mdp'];
	$status = 0;
	// insertion
	mysqli_stmt_bind_param($reqprepare,'sss',$login,$mdp,$status);
	mysqli_stmt_execute($reqprepare);
}
?>
