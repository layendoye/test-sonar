<?php
    require("haut_de_page.php");
    $_SESSION['page']='produits';
    try{
        $Abou=new \AN\EtudiantService('Universite');
        //$ab=$Abou->findAll();
        // \AN\Presentation::afficher($ab);
        //var_dump($ab);

        //$Abou->add('SS','uuu','2019-02-25','eeee@gmail.com','777');
        //add($nom,$prenom, $naissance, $email, $telephone){
        
        //var_dump($Abou->find('ETD 3')->Nom);
        
        //var_dump($Abou->findBousier('ETD 1')->Nom);
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