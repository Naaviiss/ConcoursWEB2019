<?php

session_start();

if(isset($_POST['id'])){
	$serveur = "localhost";
$login = "g1";
$mdp = "mdp01";
//nom de la base de donnees
$bd="WebContest";

//connexion au serveur mysql (ici localhost)
$connexion=mysqli_connect($serveur,$login,$mdp,$bd) 
or die("Connexion au serveur $serveur impossible pour $login");
	//  Récupération de l'utilisateur et de son pass hashé
	$sql = "SELECT * FROM personnel WHERE id LIKE '".$_POST['id']."'";
	$requete = mysqli_query($connexion,$sql	);
	while($ligne = mysql_fetch_row($requete)){
		echo 'test';
		array_push($data,$ligne);
	}

	$ligne=$requete[0];
	echo 'yo'.$requete[0];


// Comparaison du pass envoyé via le formulaire avec la base

	if ($ligne == null)
	{
		echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
		if ($ligne['mdp'] == $_POST['mdp']) {
			$_SESSION['id'] = $ligne['id'];
			if(preg_match('/^search$/',$ligne['id'])){
				$_SESSION['status'] = "search";
				header('Location : index.php');
			}
			else{
				$_SESSION['status'] = "admin";
				header('Location : admin.php');
			}
				
			echo 'Vous êtes connecté !';
		}
		else {
			echo 'Mauvais identifiant ou mot de passe !';
		}
	}
}

?>