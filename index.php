<?php
	session_start();
	$id = $_SESSION["id"];
 ?>

<!DOCTYPE html>
<?php
//$connexion = mysqli_connect("localhost","g1","mdp01")
//or die ("Tu es nul. Recommence.");
$connexion = mysqli_connect("localhost","root","")
or die ("Tu es nul. Recommence.");

$bd="WebContest";

mysqli_select_db($connexion,$bd)
or die ("Toujours pas.");

$requete="select * from Ressource";
$resultat=mysqli_query($connexion,$requete);
echo "<h1> Voici la table des ressources.</h1>";
echo "<table border='1' cellpadding='5' cellpacing='9'>";
while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";
	for ($i =0;$i<4;$i++){
			if ($i != 3){
				echo "<td>".$ligne[$i]."</td>";
			}
			else {
				if ($ligne[2] != null){
					//Si un chercheur a reservé
					echo "<td>".$ligne[$i]."</td>";
				}
			}

		}
		echo "</tr>";
	}
echo"</table>";

$ligne = null;
$requete="select * from Ressource where personne = $id";
$resultat=mysqli_query($connexion,$requete);
echo "<h1> Voici la table des ressources réservées par ".$id."</h1>";
echo "<table border='1' cellpadding='5' cellpacing='9'>";
while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";
	for ($i =0;$i<4;$i++){
			echo "<td>".$ligne[$i]."</td>";
		}
	echo "</tr>";
}
echo "</table";

mysqli_close($connexion);

?>

<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
