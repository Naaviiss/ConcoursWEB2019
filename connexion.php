<?php
session_start();

//Si deja connecter !
if (isset($_SESSION['id']) and !empty($_SESSION['id'])){
	echo "deja connecte";
	// header('location: index.php');
	exit();
}
//Si pas connecter détruit la session et la relance
else{
	$_SESSION = Array();
	session_destroy();
	session_start();

}	

function debug($x){
	echo "<pre>";
	print_r($x);
	echo "</pre>";
}
?>

<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Suivi des anciens élèves</title>
	
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
					<img class='img mb-1'alt='logo UVSQ site Vélizy' src="images/uvsq_iut_velizy_CMJN.jpg" /> 
					
					<form action='' method='POST'>
						<!--
						<div class="form-group">
							<h3>Connexion</h3>
							<h6>Entrez vos identifiants</h6>
						</div>			-->	

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
							<input name='connection' class="btn btn-lg btn-outline-secondary btn-block" type="submit" value="Se connecter">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<body>

<?php
	
if (isset($_POST["id"],$_POST["mdp"])){
	$login = htmlspecialchars($_POST["id"]);
	// $mdp = hash("sha256",htmlspecialchars($_POST["mdp"]));
	$mdp = htmlspecialchars($_POST["mdp"]);
		
	$req = "SELECT * FROM personnel WHERE id like \"$login\" and mdp like \"$mdp\"";
	
	if ($res = mysqli_query($connexion,$req)){ //test si la commande est bien exec
		$rowcount=mysqli_num_rows($res);
		if ($rowcount > 0) { //test si on a des resultats
			$lig = mysqli_fetch_assoc($res);
			$_SESSION['id'] = $lig['id'];
			header('location: index.php');
			exit();
		}else{
			echo '<div class="container">
					<div class="row justify-content-center">
					<p>Mot de passe ou identifiant incorrect</p>
					</div>
				</div>';
		}
	}else{ 
		echo "Impossible d'acceder a la table personnel !";
	}
}


/**TEST SI IL EXISTE AUCUN COMPTE DANS LA BD**/

$req = "SELECT * FROM personnel";
if ($res = mysqli_query($connexion,$req)){ //test si la commande est bien exec
	$rowcount=mysqli_num_rows($res);
	if ($rowcount <= 0) { //test si on a des resultats
		echo "Il n'existe pas de compte !";
		?>
		<h3>Formulaire de création compte admin</h3>
		<fieldset>
		<form action='' method='POST'><table align='center'><tr>
			<tr><td>LOGIN : </td><td><input type='text' maxsize='10' name='cid' required></td></tr>
			<tr><td>MDP :</td><td><input type='password' maxsize='10' name='cmdp' required ></td></tr>
			<tr><td>MDP (confirmation):</td><td><input type='m' maxsize='10' name='cmdpconf' required ></td></tr>
			
			<tr><td>type :</td><td> <select name="type">
									  <option value="user">user</option>
									  <option value="admin">admin</option>
									</select></td></tr>
			
			<tr><td>&nbsp;</td><td><input type='submit' name='plus' value='crée'></td></tr></table>
		</form></fieldset></div></table></div></div>	
		</fieldset>
		<?php
		
		if (isset($_POST["cid"],$_POST["cmdp"],$_POST["cmdpconf"],$_POST["type"]) and $_POST["cmdp"] == $_POST["cmdpconf"]){
			$reqinsert="INSERT into UTILISATEUR(id,mdp,status)";
			$reqinsert.="VALUES(?,?,?)";

			$reqprepare=mysqli_prepare($connexion,$reqinsert);

			//liaison des parametres :
			if (isset($_POST['cmdp'],$_POST['cmdp'],$_POST['type'])){
				$login=$_POST['cid'];
				$mdp= hash("sha256",htmlspecialchars($_POST["cmdp"]));
				/* $mdp = htmlspecialchars($_POST["cmdp"]); */
				$droit=0;

				// insertion
				mysqli_stmt_bind_param($reqprepare,'sss',$login,$mdp,$droit);
				mysqli_stmt_execute($reqprepare);
			}
		}
	}		
}else{ 
	echo "Impossible d'acceder a la table UTILISATEUR !";
}


?>