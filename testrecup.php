<?php
    // $_SESSION["date"] = date('d-m-Y');

    // $date = $_SESSION["date"];
    $date = date('d-m-Y');

    //CONNEXION DB ET RECUPERATION DATA
    $connexion = mysqli_connect("localhost","g1","mdp01","WebContest")
        or die ("Erreur lors de la connexion à la base de données");


    $requete = mysqli_query($connexion,"select * from Ressource");

    $data = array();
    $resultat =array();
    $j = 0;

    while($ligne = mysqli_fetch_row($requete))
    {
        array_push($data,$ligne);
    }

    for($i=0;$i<count($data);$i++)
    {
        if($data[$i][2] != NULL)
        {
            echo($data[$i][2]."\n");
            $nvdate = strtotime($data[$i][2]);
            echo $nvdate."\n";
            $nvformat = date('d-m-Y',$nvdate);
            echo $nvformat."\n";

            if($date == $nvformat){
                array_push($resultat,$data[$i][0],$data[$i][1],$data[$i][3]);
                $j++;
            }
        }
    }

    print_r($resultat);

    mysqli_free_result($requetep);


    mysqli_close($connexion);
?>