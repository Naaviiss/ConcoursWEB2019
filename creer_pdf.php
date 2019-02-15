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
                    if($i%count($header) == 0){
                        $this->SetFont('','B');
                        $this->SetFillColor(37,196,129);
                        $this->Cell($w,$hcell,$datum,1,0,$align,true);
                    }
                    else{
                        $this -> SetFont('');
                        $this->SetFillColor(198,245,251);
                        $this->Cell($w,$hcell,$datum,1,0,$align,$fill);
                    }

                $i++;
            }
            // Trait de terminaison
            $this->Cell($w*count($header),0,'','T');
        }
    }

    $_SESSION["date"] = date('d-m-Y');

    $pdf = new PDF();
    $date = $_SESSION["date"];

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
    $pdf->FancyTable($header,$data,$wcell);

    $pdf -> Ln(10); //on sépare les tableau

    //2eme tableau
    $pdf->Output();

?>