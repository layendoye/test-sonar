<?php require("haut_de_page.php");?>    
<body>
    <?php include('nav.php');?>
    <section class="container sect">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <form action="traitement.php" method="POST"> <?php if(isset($_GET['existe'])) $form=new Form($_SESSION['donnees']); else $form=new Form();?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Libellé','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['existe'])){ $form->input('text','Libelle','form-control col-md-7 espace','Libellé','','',false);?>
                        <?php }else{$form->input('text','Libelle','form-control col-md-7 espace blcMoins',$_SESSION['donnees']['Libelle'].' existe déja','','',false);} ?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Montant','col-md-2 espace pourLabel')?> 
                        <?php $form->input('number','Montant','form-control col-md-7 espace','Montant','','',true);?>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>                        
                        <?php $form->submit('valider_ajout_bourse','Enregistrer','form-control col-md-5 espace mb');?>
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
    if(isset($_GET["id_Categ_Bourse_sup"])){
        $sonId=$_GET["id_Categ_Bourse_sup"];
        $sup='id_Categ_Bourse_sup='.$sonId
        ?>
        <script>
            if(confirm("Confirmer la suppression ?"))
                document.location.href = "traitement.php?title=traitement&<?php echo "$sup"; ?>"
            else
                document.location.href = "batiment.php?title=batiment";
        </script>
        <?php } elseif(isset($_GET["dejaMigrer"])){?>
         <script>alert('Impossible de supprimer cette catégorie de bourse on l\'a déja octroyé à un ou plusieurs étudiants !')</script>
    <?php }
    require("footer.php");
?>