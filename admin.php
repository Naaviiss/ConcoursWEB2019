<?php
	session_start();
	$id = $_SESSION["id"];

echo "<!DOCTYPE html>
	<html lang=fr dir='ltr'>
	  <head>
	    <meta charset='utf-8'>
	    <title></title>
      <link href='css/bootstrap.min.css' rel='stylesheet' id='css2'/>
	  </head>";
//$connexion = mysqli_connect("localhost","g1","mdp01")
//or die ("Tu es nul. Recommence.");
$connexion = mysqli_connect("localhost","root","")
or die ("Tu es nul. Recommence.");

$bd="WebContest";

mysqli_select_db($connexion,$bd)
or die ("Toujours pas.");

$requete="select * from Ressource";
$resultat=mysqli_query($connexion,$requete);
echo "<body>
      <h1>Bonjour admin</h1>";
echo "<h1> Voici la table des ressources.</h1>";
echo "<table border='1' cellpadding='5' cellpacing='9'>";

echo "<tr><td>L'ID de la ressource</td><td>Le nom de la ressource</td><td>La date de reservation</td><td>Nom du chercheur</td><td>Action possible</td></tr>";

while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";
	for ($i =0;$i<4;$i++){
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
  //Bouton pour supprimer une ressource
  echo "<td><input class='favorite styled'
         type='button'
         value='supprimer'</td>";
	echo "</tr>";

}
echo"</table>";
//Bouton ajouter une ressource
echo "<input class='favorite styled'
       type='button'
       value='Ajouter une ressource'>";

echo "<h1> Gestion des utilisateurs </h1>";
$ligne =0;
while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";
	for ($i =0;$i<4;$i++){
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
  //Bouton pour supprimer une ressource
  echo "<td><input class='favorite styled'
         type='button'
         value='supprimer'</td>";
	echo "</tr>";

}
echo"</table>";

$requete="select id, mdp from Personnel where status ='user'";
$resultat=mysqli_query($connexion,$requete);
$ligne = 0;
echo "<table border='1' cellpadding='5' cellpacing='9'>";
echo "<tr><td>L'ID du chercheur</td><td>Le mot de passe du chercheur</td><td>Action possible</td></tr>";

while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";
  //$row_cnt = $resultat->num_rows;
  $row_cnt = mysqli_num_rows($resultat);
	for ($i = 0;$i<$row_cnt;$i++){
			echo "<td>".$ligne[$i]."</td>";
	}
  //Bouton pour supprimer un chercheur
  echo "<td><input class='favorite styled'
         type='button'
         value='supprimer'</td>";
  echo "</tr>";

}
echo"</table>";
//Bouton ajouter une ressource
echo "<input class='favorite styled'
       type='button'
       value='Ajouter une ressource'>";


echo "<pre></pre>";
//Bouton pour le pdf
echo "<button type='button' class='btn btn-primary' href='./creer_pdf.php'>Générer un PDF</button>";


mysqli_close($connexion);
echo "</body>
					</html>"
?>
