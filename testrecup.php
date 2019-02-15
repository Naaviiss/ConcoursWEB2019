<?php
    // $_SESSION["date"] = date('d-m-Y');

    // $date = $_SESSION["date"];
    $date = date('d-m-Y');

    //CONNEXION DB ET RECUPERATION DATA
    $connexion = mysqli_connect("localhost","g1","mdp01","WebContest")
        or die ("Erreur lors de la connexion à la base de données");


    $requete = mysqli_query($connexion,"select * from Ressource");

    $data = array();

    while($ligne = mysqli_fetch_row($requete))
    {
        array_push($data,$ligne);
    }

    for($i=0;$i<count($data);$i++)
    {
        if($data[$i][0] != NULL)
        {
            echo($data[$i][0]."\n");
        }
    }

    mysqli_free_result($requetep);


    mysqli_close($connexion);
?>