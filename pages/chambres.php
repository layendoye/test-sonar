<?php require("haut_de_page.php");?>    
<body>
    <?php include('nav.php');?>
    <section class="container sect">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <form action="traitement.php" method="POST"> <?php if(isset($_GET['existe'])) $form=new Form($_SESSION['donnees_ch']); else $form=new Form();?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Chambre','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['existe']) && !isset($_GET['id_Chambre_mod'])){ $form->input('number','chambre','form-control col-md-7 espace','Numéro chambre','','',false);?>
                        <?php }elseif(isset($_GET['existe'])  && !isset($_GET['id_Chambre_mod'])){$form->input('number','chambre','form-control col-md-7 espace blcMoins',$_SESSION['donnees_ch']['chambre'].' existe déja dans ce batiment','','',false);?>
                        <?php }elseif(isset($_GET['id_Chambre_mod'])){
                            $_SESSION['id_Chambre']=$_GET['id_Chambre_mod'];
                            $form->input('number','chambre','form-control col-md-7 espace','Numéro chambre',EtudiantService::find('Chambres','Numero_Ch','id_Chambre',$_GET['id_Chambre_mod'])[0]->Numero_Ch,'',false);}?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Batiment','col-md-2 espace pourLabel');
                        $batiment=EtudiantService::find('Batiment','Nom_bat');
                        if(!isset($_GET['existe']) && !isset($_GET['id_Chambre_mod'])) $form->select($batiment,'Batiment','form-control col-md-7 espace');
                        elseif(isset($_GET['existe'])  && !isset($_GET['id_Chambre_mod'])) $form->select($batiment,'Batiment','form-control col-md-7 espace',$_SESSION['donnees_ch']['Batiment']);
                        elseif(isset($_GET['id_Chambre_mod'])) {
                            $id_bat=EtudiantService::find('Chambres','id_Batiment','id_Chambre',$_GET['id_Chambre_mod'])[0]->id_Batiment;
                            $form->select($batiment,'Batiment','form-control col-md-7 espace',EtudiantService::find('Batiment','Nom_bat','id_Batiment',$id_bat)[0]->Nom_bat);}?>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>                        
                        <?php if(isset($_GET['id_Chambre_mod']) || isset($_GET['mod'])) $form->submit('valider_modif_ch','Modifier','form-control col-md-5 espace mb');
                        else $form->submit('valider_ajout_ch','Ajouter','form-control col-md-5 espace mb');?>
                    </div>
                    
                </form>
            </div>
        </div>
         <!-- Debut tableau -->
        <?php
        $titres=array('Numero chambre','Batiment','Nombres étudiants','Modification','Supprimer');
        $class=array('col-md-2 text-center','col-md-2 text-center','col-md-3 text-center','col-md-3 text-center','col-md-2 text-center');
        $chambres=EtudiantService::find('Chambres');
        $mod=Affichage::bouton_mod_chambres($class,$chambres);
        $sup=Affichage::bouton_sup_chambres($class,$chambres);
        Affichage::tableau_chambre($titres,$class,$chambres,'col-12 Mes_tableaux table-hover','','row',$mod,$sup);
        ?>
        <!-- Fin tableau -->
    </section>
</body>
<?php 
    if(isset($_GET["id_Chambre_sup"])){
        $sonId=$_GET["id_Chambre_sup"];
        $sup='id_Chambre_sup='.$sonId
        ?>
        <script>
            if(confirm("Confirmer la suppression ?"))
                document.location.href = "traitement.php?title=traitement&<?php echo "$sup"; ?>"
            else
                document.location.href = "chambres.php?title=chambres";
        </script>
        <?php } elseif(isset($_GET["dejaMigrer"])){?>
         <script>alert('Impossible de supprimer cette chambre car elle contient un ou plusieurs étudiants !')</script>
    <?php }
    require("footer.php");
?>