<?php
    // $_SESSION["date"] = date('d-m-Y');

    // $date = $_SESSION["date"];
    $date = date('d-m-Y');

    //CONNEXION DB ET RECUPERATION DATA
    $connexion = new mysqli("localhost","g1","mdp01","WebContest")
        or die ("Erreur lors de la connexion à la base de données");
    
    // $bd = "WebContest";

    // mysqli_select_db($connexion,$bd)
    //     or die("Erreur lors de l'accès à la base de données");

    // if(!($requeteprep = $connexion->prepare("select id,nom,chercheur from Ressource where date_format(jour,'%d-%m-%Y') = :date"))){
        echo "la ca marche pa";
    }
    
    if(!$requeteprep->bind_param(':date',$date)){
        echo("la ca marche pas");
    }

    if(!$requeteprep -> execute()){
        echo("ca marche pas");
    }

    $data = array();

    $resultat = $requeteprep->get_result();

    while($ligne = mysqli_fetch_row($resultat))
    {
        array_push($data,$ligne);
    }

    var_dump($resultat);

    var_dump($data);

    $requeteprep -> close();


    mysqli_close($connexion);
?>