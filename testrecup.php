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

    if(!($requeteprep = $connexion->prepare("select id,nom,chercheur from Ressource where date_format(jour,'%d-%m-%Y') = ?"))){
        echo "la ca marche pa";
    }
    
    if(!$requeteprep->bind_param("s",$date)){
        echo("la ca marche pas");
    }

    if(!$requeteprep -> execute()){
        echo("ca marche pas");
    }

    $data = array();

    $i = 0;

    while($ligne = $requeteprep->get_result()->fetch_row())
    {
        array_push($data,$ligne);
        $i++;
    }

    var_dump($data);

    $requeteprep -> close();


    mysqli_close($connexion);
?>