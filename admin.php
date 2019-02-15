<?php
	session_start();
	$id = $_SESSION["id"];

echo "<!DOCTYPE html>
	<html lang=fr dir='ltr'>
	  <head>
	    <meta charset='utf-8'>
	    <title></title>
      <link href='css/bootstrap.min.css' rel='stylesheet' id='css2'/>

      <script type='text/javascript'>
      function bascule(id)
      {
      	if (document.getElementById(id).style.visibility == 'hidden')
      			document.getElementById(id).style.visibility = 'visible';
      	else{
        	document.getElementById(id).style.visibility = 'hidden';
        }
      }
      </script>
	  </head>";

 $connexion = mysqli_connect("localhost","g1","mdp01")
 or die ("Tu es nul. Recommence.");
//$connexion = mysqli_connect("localhost","root","")
//or die ("Tu es nul. Recommence.");

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
	for ($i =1;$i<5;$i++){
		//La ligne sur la date
		if ($i ==4 || $i==3){
			//Est-ce que la date est renseignée?
			if ($ligne[3] != null){
				//Si un chercheur a reservé
				echo "<td>".$ligne[$i]."</td>";
			}
			else{
				echo "<td> Disponible </td>";
			}

		}
		else{
			echo "<td>".$ligne[$i]."</td>";
		}
	}
  //Bouton pour supprimer une ressource
  echo "<td><a href='supprimeressource.php?id=".$i."'>Cliquer ici pour supprimer une ressource</a></td>";

	echo "</tr>";

}
echo"</table>";
//Bouton ajouter une ressource
//echo "<div id='bouton' onclick=\"bascule('header1');\">Ajouter une ressource</div>";
echo"<div class=\"input-group mb-3\"  onclick=\"bascule('header1');\">
        <form method=\"post\" action=\"traitement.php\">
            <p>
                <label for=\"pseudo\">L'id :</label>
                <input type=\"text\" name=\"id\" id=\"id\" placeholder=\"Ex : Zozor\" size=\"30\" maxlength=\"10\" /></br>
                <label for=\"pseudo\">Le nom de la ressource :</label>
                <input type=\"text\" name=\"nom\" id=\"nom\" placeholder=\"Ex : Zozor\" size=\"30\" maxlength=\"10\" /></br>
            </p>

          <select class=\"custom-select\" id=\"inputGroupSelect02\">
            <option selected>Choisissez une ressource</option>
            <option value=\"3DPrinter\">3DPrinter</option>
            <option value=\"DroneXXL360r\">DroneXXL360r</option>
            <option value=\"Harm256\">Harm256</option>
          </select>

          <INPUT TYPE=\"submit\" NAME=\"nom\" VALUE=\" Envoyer \">;
        </form>
      </div>";
echo "<div id='header1' style=\"visibility:hidden;\">

<form method=\"post\" action=\"traitement.php\">
    <p>
        <label for=\"pseudo\">L'id :</label>
        <input type=\"text\" name=\"id\" id=\"id\" placeholder=\"Ex : Zozor\" size=\"30\" maxlength=\"10\" /></br>
        <label for=\"pseudo\">Le nom de la ressource :</label>
        <input type=\"text\" name=\"nom\" id=\"nom\" placeholder=\"Ex : Zozor\" size=\"30\" maxlength=\"10\" /></br>
    </p>
</form>

";

echo "<INPUT TYPE=\"submit\" NAME=\"nom\" VALUE=\" Envoyer \"></div>";

echo "<h1> Gestion des utilisateurs.</h1>";


$requete="select * from Personnel where status ='user'";
$resultat=mysqli_query($connexion,$requete);
$ligne = 0;
echo "<table border='1' cellpadding='5' cellpacing='9'>";
echo "<tr><td>L'ID du chercheur</td><td>Le mot de passe du chercheur</td><td>Status</td><td>Action possible</td></tr>";
$test = 0;
$compteur=0;
while($ligne=mysqli_fetch_row($resultat)){
	echo "<tr>";
  $test = $ligne[0];
  //$row_cnt = $resultat->num_rows;
  $row_cnt = mysqli_num_rows($resultat);
	for ($i = 0;$i<3;$i++){
			echo "<td>".$ligne[$i]."</td>";
	}
  //Bouton pour supprimer un chercheur
  echo "<td><a href='supprimechercheur.php?id=".$test."'>supprimer</a></td>";
  $compteur=$compteur+1;
  echo "</tr>";

}
echo"</table>";
//Bouton un chercheur
echo "<div id='bouton' onclick=\"bascule('header');\">Ajouter un chercheur</div>";
echo "<div id='header' style=\"visibility:hidden;\">

<form method=\"post\" action=\"ajouterchercheur.php\">
    <p>
        <label for=\"pseudo\">L'id :</label>
        <input type=\"text\" name=\"id\" id=\"id\" placeholder=\"Ex : Zozor\" size=\"30\" maxlength=\"10\" /></br>
        <label for=\"pseudo\">Le mot de passe :</label>
        <input type=\"text\" name=\"mdp\" id=\"mdp\" placeholder=\"Ex : Zozor\" size=\"30\" maxlength=\"10\" /></br>
    </p>
    <INPUT TYPE=\"submit\" NAME=\"nom\" VALUE=\" Envoyer \">;
</form>

echo "<pre></pre>";
//Bouton pour le pdf
echo "<button type='button' class='btn btn-primary' href='./creer_pdf.php'>Générer un PDF</button>";


mysqli_close($connexion);
echo "</body>
					</html>"
?>
