<?php
    require('./fpdf.php');

    class PDF extends FPDF
    {
        // Tableau coloré
        function FancyTable($header, $data,$w)
        {
            // Couleurs, épaisseur du trait et police grasse
            $this->SetFillColor(37,196,129);
            $this->SetTextColor(66,69,88);
            $this->SetDrawColor(66,69,88);
            $this->SetLineWidth(.3);
            $this->SetFont('','B');

            //définition taille et remplissage cellules
            $hcell = 10;
            $align = 'C';
            $fill = false;

            for($i=0;$i<count($header);$i++)
                $this->Cell($w,$hcell,utf8_decode($header[$i]),1,0,$align,true);

            $this->Ln();

            // Restauration des couleurs et de la police
            $this->SetFillColor(198,245,251);
            $this -> SetFont('');

            $i = 0;
            foreach($data as $datum)
            {
                     $this -> SetFont('');
                        $this->SetFillColor(198,245,251);
                        $this->Cell($w,$hcell,$datum,1,0,$align,$fill);
                    

                $i++;
            }
            // Trait de terminaison
            $this->Cell($w*count($header),0,'','T');
        }
    }

    $pdf = new PDF();
    

    //CONNEXION DB ET RECUPERATION DATA
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
            $nvdate = strtotime($data[$i][2]);
            $nvformat = date('d-m-Y',$nvdate);


            if($date == $nvformat){
                array_push($resultat,$data[$i][0],$data[$i][1],$data[$i][3]);
                $j++;
            }
        }
    }

    mysqli_free_result($requetep);


    mysqli_close($connexion);


    // Titres des colonnes
    $header = array("Identifiant","Nom de la ressource","Chercheur");

    // Chargement des données
    // $data = $_SESSION["table"];
    $pdf->AddPage('L','A4');
    $wcell = 90; //largeur des cellules

    $pdf->SetFont('Times','B',14);
    $pdf->SetTextColor(66,69,88);
    $pdf ->Cell(300,10,utf8_decode("Historique des ressources du ".$date),'',0,'C'); //ajout du titre
    $pdf -> Ln(15);

    $pdf->SetFont('Times','',12);
    $pdf->FancyTable($header,$resultat,$wcell);

    $pdf -> Ln(10); //on sépare les tableau

    //2eme tableau
    $pdf->Output();

?>