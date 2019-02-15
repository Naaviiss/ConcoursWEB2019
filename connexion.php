<?php

session_start();

$serveur = "localhost";
$login = "root";
$mdp = "";
//nom de la base de donnees
$bd="webcontest";

//connexion au serveur mysql (ici localhost)
$connexion=mysqli_connect($serveur,$login,$mdp,$bd) 
or die("Connexion au serveur $serveur impossible pour $login");


if(isset($_POST['id'])){
	//  Récupération de l'utilisateur et de son pass hashé
	$sql = "SELECT id,mdp FROM personnel WHERE id LIKE ".$_POST['id'];
	$requete = mysqli_query($connexion,$sql	);
	while($ligne = mysql_fetch_assoc($requete)){
		array_push($data,$ligne);
	}

	$ligne=$requete[0];
	echo $requete[0];


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
			}
			else{
				$_SESSION['status'] = "admin";
			}
				
			echo 'Vous êtes connecté !';
		}
		else {
			echo 'Mauvais identifiant ou mot de passe !';
		}
	}
}

?>