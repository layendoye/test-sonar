<?php
    require("haut_de_page.php");
    $_SESSION['page']='produits';
    try{
        $service=new EtudiantService();
        $etudiant=new Boursiers('','QQQ','aaa','2019-02-25','eeee@gmail.com','777','Demi-pension');
        EtudiantService::add($etudiant);
        
        //var_dump(EtudiantService::find('Etudiants'));
        //var_dump(EtudiantService::findd('1 ETD','Etudiants'));
        //var_dump(EtudiantService::checkStatut('2 ETD'));
        //$etudiant=new Loges('','Awa','Ciss','2019-02-25','ac@gmail.com','777','Demi-pension',1);
        //$etudiant=new Non_Boursiers('','tt','dd','2019-02-25','ac@gmail.com','777','pmmm');
        //$service->add($etudiant);

        // echo'<form action="" method="POST">';
        // $form=new Form($_POST);
        // $form->input('text','username','form-control',true);
        // $form->input('text','userna','form-control');
        // $form->submit('valider','Envoyer','form-control');
        
        // echo'</form>';

        //var_dump($service->findCategorie_Bourse(1));

        //var_dump($service->checkStatut('ETD 2'));
    }
    catch(PDOException $e){
        echo "ECHEC : " . $e->getMessage();
    }
?> 