<!DOCTYPE html>
<?php

require("parametres.php");

$connexion = mysqli_connect($serveur,$login,$mdp)
or die ("Tu es nul. Recommence.");

$bd="WebContest";

mysqli_select_db($connexion,$bd)
or die ("Toujours pas.");

$requete="select * from Ressource";
$resultat=mysqli_query($connexion,$requete);
echo "<table border='1' cellpadding='5' cellpacing='9'>";
while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";

	echo "<td>L'id est : ".$ligne['id']."</td>";
	echo "<td>Le nom de la ressource est :".$ligne['nom']."</td>";
	echo "<td>Le jour de réservation est :".$ligne['jour']."</td>";
  if  ($ligne['jour'] == null){
		echo "<td>La ressource est réservée par :".$ligne['jour']."</td>";

	}
	echo "</tr>";
}
echo"</table>";
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
