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
	$sql = "SELECT * FROM personnel WHERE id LIKE ?";
	$requete = $connexion->prepare($sql);
	$requete->bind_param("s",$_POST['id']);
	$requete ->bind_result($id,$mdp);
	while($requete->fetch()){
		echo 'id '.$id;
		echo 'mdp '.$mdp;
	}

	$requete->close();

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