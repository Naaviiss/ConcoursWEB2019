<?php
	session_start();
	$id = $_SESSION["id"];
 ?>

<!DOCTYPE html>
<?php
$connexion = mysqli_connect("localhost","g1","mdp01")
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

	echo "<td>L'id est : ".$ligne['id']."</td>";
	echo "<td>Le nom de la ressource est :".$ligne['nom']."</td>";
	echo "<td>Le jour de réservation est :".$ligne['jour']."</td>";
  if  ($ligne['jour'] == null){
		echo "<td>La ressource est réservée par :".$ligne['id_pers']."</td>";

	}
	echo "</tr>";
}
echo"</table>";


echo "<h1> Voici la table des ressources réservées par ".$id."</h1>";
echo "<table border='1' cellpadding='5' cellpacing='9'>";
while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";
	if ($id == $ligne['id_pers']){
		echo "<td>L'id est : ".$ligne['id']."</td>";
		echo "<td>Le nom de la ressource est :".$ligne['nom']."</td>";
		echo "<td>Le jour de réservation est :".$ligne['jour']."</td>";
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
