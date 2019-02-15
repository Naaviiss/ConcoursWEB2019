<?php
    // $_SESSION["date"] = date('d-m-Y');

    // $date = $_SESSION["date"];
    $date = date('d-m-Y');

    //CONNEXION DB ET RECUPERATION DATA
    $connexion = mysqli_connect("localhost","g1","mdp01")
        or die ("Erreur lors de la connexion à la base de données");
    
    $bd = "WebContest";

    mysqli_select_db($connexion,$bd)
        or die("Erreur lors de l'accès à la base de données");

    $requeteprep= $connexion->prepare("select id,nom,chercheur from Ressource where date_format(jour,'%d-%m-%Y') = :date");
    $requeteprep->bind_param(':date',$date);

    $requeteprep -> execute();

    $data = array();

    $resultat = $requeteprep->get_result();

    while($ligne = mysqli_fetch_row($resultat))
    {
        array_push($data,$ligne);
    }

    print_r($resultat);

    print_r($data);

    $requeteprep -> close();


    mysqli_close($connexion);
?>