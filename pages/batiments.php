<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>      
<body>
    <?php include('nav.php');?>
    <section class="container sect">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <form action="traitement.php" method="POST"> <?php if(isset($_GET['existe'])) $form=new Form($_SESSION['donnees_bat']); else $form=new Form();?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Nom','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['existe']) && !isset($_GET['id_Batiment_mod'])){ $form->input('text','batiment','form-control col-md-7 espace','Nom du batiment','','',false);?>
                        <?php }elseif(!isset($_GET['id_Batiment_mod'])){$form->input('text','batiment','form-control col-md-7 espace blcMoins',$_SESSION['donnees_bat']['batiment'].' existe déja','','',false);
                        }elseif(isset($_GET['id_Batiment_mod'])){
                            $_SESSION['id_Batiment_mod']=$_GET['id_Batiment_mod'];
                            $form->input('text','batiment','form-control col-md-7 espace','Nom du batiment',EtudiantService::find('Batiment','Nom_bat','id_Batiment',$_GET['id_Batiment_mod'])[0]->Nom_bat,'',false);;}?>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>                        
                        <?php if(!isset($_GET['id_Batiment_mod'])) $form->submit('valider_ajout_batiment','Ajouter','form-control col-md-5 espace mb');
                                else {
                                    $form->submit('valider_modif_batiment','Modifier','form-control col-md-5 espace mb');
                                    $_SESSION['id_Batiment_mod']=$_GET['id_Batiment_mod'];}?>
                    </div>
                </form>
            </div>
        </div>
         <!-- Debut tableau -->
        <?php
        $titres=array('Numero','Nom','Nombres chambres','Nombres étudiants','Modification','Supprimer');
        $class=array('col-md-1 text-center','col-md-3 text-center','col-md-2 text-center','col-md-2 text-center','col-md-2 text-center','col-md-2 text-center');
        $batiment=EtudiantService::find('Batiment');
        $mod=Affichage::bouton_mod_bat($class,$batiment);
        $sup=Affichage::bouton_sup_bat($class,$batiment);
        //die(var_dump($sup));
        Affichage::tableau_bat($titres,$class,$batiment,'col-12 Mes_tableaux table-hover','','row',$mod,$sup);
        ?>
        <!-- Fin tableau -->
    </section>
</body>
<?php 
    if(isset($_GET["id_Batiment_sup"])){
        $sonId=$_GET["id_Batiment_sup"];
        $sup='id_Batiment_sup='.$sonId
        ?>
        <script>
            if(confirm("Confirmer la suppression ?"))
                document.location.href = "traitement.php?title=traitement&<?php echo "$sup"; ?>"
            else
                document.location.href = "batiments.php?title=batiment";
        </script>
        <?php } elseif(isset($_GET["dejaMigrer"])){?>
         <script>alert('Impossible de supprimer ce batiment car elle contient une ou plusieurs chambres !')</script>
    <?php }
    require("footer.php");
?>