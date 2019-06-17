<?php
    require("haut_de_page.php");
    $_SESSION['page']='produits';
    try{
        $Abou=new \AN\EtudiantService();
        $ab=$Abou->les_etudiants;
        \AN\Presentation::afficher($ab);
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