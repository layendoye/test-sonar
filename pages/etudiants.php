<?php
    require("haut_de_page.php");
    $_SESSION['page']='produits';
    try{
        $service=new EtudiantService();

        //$etudiant=new Boursiers('','Papy','Nd','2019-02-25','eeee@gmail.com','777','Demi-pension');
        $etudiant=new Loges('','Awa','Ciss','2019-02-25','ac@gmail.com','777','Demi-pension',1);
        //$etudiant=new NonLoges('','tt','dd','2019-02-25','ac@gmail.com','777','pmmm');
        $service->add($etudiant);

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
<body>
   <h1 class="clo-md-10">Testes en POO</h1>
   
</body>
<?php
    require("footer.php");
?>