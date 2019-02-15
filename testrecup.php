<?php
    // $_SESSION["date"] = date('d-m-Y');

    // $date = $_SESSION["date"];
    $date = date('d-m-Y');

    //CONNEXION DB ET RECUPERATION DATA
    $connexion = mysqli_connect("localhost","g1","mdp01","WebContest")
        or die ("Erreur lors de la connexion à la base de données");


    $requete = mysqli_query("select * from Ressource");

    $data = array();

    while($ligne = mysqli_fetch_assoc($requete))
    {
        array_push($data,$ligne);
    }

    var_dump($data);

    mysqli_free_result($requetep);


    mysqli_close($connexion);
?>