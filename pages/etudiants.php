<?php
    require("haut_de_page.php");
    $_SESSION['page']='produits';
    try{
        $Abou=new \AN\EtudiantService('Universite');
        //$ab=$Abou->findAll();
        // \AN\Presentation::afficher($ab);
        //var_dump($ab);

        // $Abou->add('SS','uuu','2019-02-25','eeee@gmail.com','777');
        // $Abou->addBoursier('ETD 4',1);
        //add($nom,$prenom, $naissance, $email, $telephone){
        
        //var_dump($Abou->find('ETD 3')->Nom);
        
        //var_dump($Abou->findBousier('ETD 1')->Nom);

        //var_dump($Abou->findNonBousier('ETD 3')->Naissance);

        //var_dump($Abou->findAllBoursiers());

        //var_dump($Abou->findAllLoges());

        // var_dump($Abou->findAllBatiment());
        //var_dump($Abou->findAllLogement());

        // echo'<form action="" method="POST">';
        // $form=new \AN\Form($_POST);
        // $form->input('text','username','form-control',true);
        // $form->input('text','userna','form-control');
        // $form->submit('valider','Envoyer','form-control');
        
        // echo'</form>';

        var_dump($Abou->findCategorie_Bourse(1));
    }
    catch(\PDOException $e){
        echo "ECHEC : " . $e->getMessage();
    }
    
?>    
<body>
   <h1 class="clo-md-10">Testes en POO</h1>
   
</body>
<?php
    require("footer.php");
?>