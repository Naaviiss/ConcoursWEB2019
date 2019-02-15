<?php
	session_start();
	$id = $_SESSION["id"];

echo "<!DOCTYPE html>
	<html lang=fr dir='ltr'>
	  <head>
	    <meta charset='utf-8'>
	    <title></title>
	  </head>";
$connexion = mysqli_connect("localhost","g1","mdp01")
or die ("Tu es nul. Recommence.");
//$connexion = mysqli_connect("localhost","root","")
//or die ("Tu es nul. Recommence.");

$bd="WebContest";

mysqli_select_db($connexion,$bd)
or die ("Toujours pas.");

$requete="select id,nom,jour,personne from Ressource";
$resultat=mysqli_query($connexion,$requete);
echo "<body>";
echo "<h1> Voici la table des ressources.</h1>";
echo "<table border='1' cellpadding='5' cellpacing='9'>";

echo "<tr><td>L'ID de la ressource</td><td>Le nom de la ressource</td><td>La date de reservation</td><td>Nom du chercheur</td></tr>";

while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";
	for ($i =0;$i<4;$i++){
		  $test = $ligne[0];
		//La ligne sur la date
		if ($i ==2 || $i==3){
			//Est-ce que la date est renseignée?
			if ($ligne[2] != null){
				//Si un chercheur a reservé
				echo "<td>".$ligne[$i]."</td>";
			}
			else{
				echo "<td> Vide </td>";
			}

		}
		else{
			echo "<td>".$ligne[$i]."</td>";
		}
	}
	if ($ligne[2] == null){
			//Si pas reservé
		echo "<td>
				<a href='reservation.php?id=".$test."'>Reservez</a>
			</td>";			
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
	for ($i =0;$i<3;$i++){
			echo "<td>".$ligne[$i]."</td>";
		}
	echo "</tr>";
}
echo "</table";

mysqli_close($connexion);
echo "</body>
					</html>"
?>
