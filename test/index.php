<?php
session_start();

//Si la session n'est pas démarré ou si le bouton deconnexion a été enclanché 
//ou si les variables session initialiser a la connexion sont vide 
//-> détruit la session
if(empty($_SESSION) or isset($_POST['deco']) or !isset($_SESSION['id'],$_SESSION['status'])){
	$_SESSION = Array();
	session_destroy();
	// header('location: connexion.php');
	exit();
}


function debug($x){
	echo "<pre>";
	print_r($x);
	echo "</pre>";
}
?>	
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>SearchWhat</title>
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	</head>
	<body>		
		<nav class="navbar navbar-expand-md navbar-dark">
		
			<button class="navbar-toggler mt-1 mb-1 ml-3" type="button" data-toggle="collapse" data-target="#barre_de_nav" aria-controls="#barre_de_nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="barre_de_nav">
				<ul class="navbar-nav mr-auto" >
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Accueil</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="annuaire.php">Annuaire</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="mail.php">Envoyer un mail</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="analyse.php">Analyses</a>
					</li>
					<?php if ($_SESSION['status'] == 'admin'){ ?>
							<li class="nav-item active">
								<a class="nav-link" href="admin.php">Administration</a>
							</li>
					<?php } ?>


				</ul>
				<form class="form-inline my-2 my-lg-0 mr-3 ml-2 mb-1" action='' method='POST'>
					<button class="btn btn-danger my-2 my-sm-0" action='submit' name='deco' >Déconnexion</button>
				</form>
			</div>
		</nav>

		<!--<div id='contenue' class='container-fluid'>
			<header>
				<center><h1>Accueil</h1></center>
			</header>
			
			<div class="form-row">
				<div class="form-group col-md-2">
					<label for="historique">Historique des actions </label>
				</div>
				<div class="input-group col-md-9">
					<textarea class="form-control disable" name="historique" rows="10" readonly><?php
					
					// $file = fopen ("historique/actions.txt", "r");
					// while(!feof($file)){
						// echo fgets($file,255);
					// }
					// fclose ($file);
					
					
					?></textarea>
				</div>
			</div>-->

		
		</div>
		
		
    </body>


</html>