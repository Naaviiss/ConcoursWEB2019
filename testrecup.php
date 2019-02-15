<?php
    // $_SESSION["date"] = date('d-m-Y');

    // $date = $_SESSION["date"];
    $date = date('d-m-Y');

    //CONNEXION DB ET RECUPERATION DATA
    $bd = "WebContest";
    $connexion = mysqli_connect("localhost","g1","mdp01",$bd)
        or die ("Erreur lors de la connexion à la base de données");

    if(!($requeteprep = mysqli_prepare("select id,nom,chercheur from Ressource where date_format(jour,'%d-%m-%Y') = ?"))){
        echo "la ca marche pa";
    }
    
    if(!mysqli_stmt_bind_param($requeteprep,"s",$date)){
        echo("la ca marche pas");
    }

    if(!mysqli_stmt_execute($requeteprep)){
        echo("ca marche pas");
    }

    if(!mysqli_stmt_bind_result($requeteprep,$id,$nom,$chercheur)){
        echo("ca marche pas ici");
    }

    $data = array();
    $i = 0;

    while(mysqli_stmt_fetch($requeteprep))
    {
        array_push($data,$id,$nom,$chercheur);
        $i++;
    }

    var_dump($data);

    mysqli_stmt_close($requeteprep);


    mysqli_close($connexion);
?>