<?php
// session_start();

// Si deja connecter !
// if (isset($_SESSION['id']) and !empty($_SESSION['id'])){
	// echo "deja connecte";
	// header('location: index.php');
	// exit();
// }
// Si pas connecter détruit la session et la relance
// else{
	// $_SESSION = Array();
	// session_destroy();
	// session_start();

// }


?>

<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>A EXECUTER</title>
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</head>
<body>
		
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xs-2 col-sm-9 col-md-7 col-lg-5">
				<div class="panel panel-default connexion">	
					
					<form action='connexion.php' method='POST'>
						
						<div class="form-group">
							<h3>Connexion</h3>
							<h6>Entrez vos identifiants</h6>
						</div>			

						<div class="form-group">
							<input class="form-control" placeholder="Identifiant" name="id" type="text" <?php
							if (isset($_POST['id'])){
								echo "value="."'".$_POST['id']."'";
							}?> required>
						</div>
						
						<div class="form-group">
							<input class="form-control" placeholder="Mot de passe" name="mdp" type="password" value="" required>
						</div>
						
						<div class='input-group'>
							<input name='connexion' class="btn btn-lg btn-outline-secondary btn-block" type="submit" value="Inscription">
						</div>
					</form>
	

				</div>
			</div>
		</div>
	</div>
<body>

<?php



$serveur = "localhost";
$login = "root";
$mdp = "";

//connexion au serveur mysql (ici localhost)
$connexion=mysqli_connect($serveur,$login,$mdp) 
or die("Connexion au serveur $serveur impossible pour $login");


//nom de la base de donnees
$bd="webcontest";

//connexion à la base de donnees
mysqli_select_db($connexion,$bd)
or die("Impossible d'acceder à la base de données");	

if(isset($_POST['id'])){
	//  Récupération de l'utilisateur et de son pass hashé
	$req = $connexion->prepare('SELECT id, mdp FROM personnel WHERE id = ?');
	$req -> bind_param("s",$_POST['id']);
	$req->execute();
	$resultat = $req->fetch();
	echo $resultat;


// Comparaison du pass envoyé via le formulaire avec la base

	if (!$resultat)
	{
		echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
		if ($resultat['mdp'] == $_POST['mdp']) {
			session_start();
			$_SESSION['id'] = $resultat['id'];
			$_SESSION['pseudo'] = $_POST['id'];
			echo 'Vous êtes connecté !';
		}
		else {
			echo 'Mauvais identifiant ou mot de passe !';
		}
	}
}

?>