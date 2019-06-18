<?php
    require("haut_de_page.php");
    $_SESSION['page']='produits';
    try{
        $service=new \AN\EtudiantService('Universite');
        //var_dump($service->findAll());
        // \AN\Presentation::afficher($ab);
        //var_dump($service->find_indice(0));

        // $service->add('SS','uuu','2019-02-25','eeee@gmail.com','777');
        // $service->addBoursier('ETD 4',1);
        //add($nom,$prenom, $naissance, $email, $telephone){
        
        //var_dump($service->find('ETD 3')->Nom);
        
        //var_dump($service->findBousier('ETD 1')->Nom);

        //var_dump($service->findNonBousier('ETD 3')->Naissance);

        //var_dump($service->findAllBoursiers());

        //var_dump($service->findAllLoges());

        // var_dump($service->findAllBatiment());
        //var_dump($service->findAllLogement());

        // echo'<form action="" method="POST">';
        // $form=new \AN\Form($_POST);
        // $form->input('text','username','form-control',true);
        // $form->input('text','userna','form-control');
        // $form->submit('valider','Envoyer','form-control');
        
        // echo'</form>';

        //var_dump($service->findCategorie_Bourse(1));
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