<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>      
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
        <!-- Début formulaire -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <form action="traitement.php?title=traitement" method="POST"> <?php $form=new Form($_POST);?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Nom','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','nom','form-control col-md-7 espace','Nom','','',false,false);?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Prénom','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','prenom','form-control col-md-7 espace','Prénom','','',false,false);?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Naissance','col-md-2 espace pourLabel')?> 
                        <?php $form->input('date','naiss','form-control col-md-7 espace','');?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Email','col-md-2 espace pourLabel')?> 
                        <?php $form->input('email','email','form-control col-md-7 espace','Email','','',false,false);?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Téléphone','col-md-2 espace pourLabel')?> 
                        <?php $form->input('number','tel','form-control col-md-7 espace','Téléphone','','',false,false);?>
                    </div>
                    <div class="row">
                        <div class=""></div>
                       <?php $form->label('','Non Boursier','col-md-3 espace pourLabel centrerDroite')?> 
                        <?php $form->input('radio','choix','form-control col-md-1 espace btRadio','','Non Boursier','nonBoursier','','afficherPourNonBoursier()');?>
                        <?php $form->label('','Boursier','col-md-2 espace pourLabel centrerDroite')?>
                        <?php $form->input('radio','choix','form-control col-md-1 espace btRadio','','Boursier','Boursier','','afficherPourBoursier()');?>
                        <?php $form->label('','Loger','col-md-2 espace pourLabel centrerDroite')?>
                        <?php $form->input('radio','choix','form-control col-md-1 espace btRadio','','Loger','Loger','','afficherPourLoge()');?>
                    </div>
                    <div class="row" id='typeBourse'>
                        <div class="col-md-1"></div>
                       <?php $form->label('','Bourse','col-md-2 espace pourLabel')?>
                        <?php $tab_option=EtudiantService::find('Categorie_Bourse','Libelle');
                        $form->select($tab_option,'type_bour','form-control col-md-7 espace');?>
                    </div>
                    <div class="row" id='Chambre'>
                        <div class="col-md-1"></div>
                        <?php $form->label('','Chambre','col-md-2 espace pourLabel')?> 
                       <?php Affichage::selectChambre('chambre','form-control col-md-7 espace');?> 
                    </div>
                    <div class="row" id='adresse'>
                        <div class="col-md-1"></div>
                       <?php $form->label('','Adresse','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','adresse','form-control col-md-7 espace','Adresse');?>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>                        
                        <?php $form->submit('valider_ajout_etudiant','Enregistrer','form-control col-md-5 espace mb');?>
                    </div>
                </form>
            </div>
        </div>
        <!-- Fin formulaire -->

        <!-- Debut tableau -->
        <?php
        $titres=array('Matricule','Nom','Prenom','Naissance','Email','Telephone','Info','Supprimer');
        $class=array('col-md-1 text-center','col-md-2 text-center','col-md-2 text-center','col-md-1 text-center','col-md-3 text-center','col-md-1 text-center','col-md-1 text-center','col-md-1 text-center');
        $etudiants=EtudiantService::find('Etudiants');
        $info=Affichage::bouton_inf_etu($class,$etudiants);
        $up=Affichage::bouton_sup_etu($class,$etudiants);
        $form->tableau($titres,$class,$etudiants,'col-12 Mes_tableaux table-hover','','row',$info,$up);
        ?>
        <!-- Fin tableau -->
    </section>
</body>
<?php 
    if(isset($_GET["matricule_sup"])){
        $sonId=$_GET["matricule_sup"];
        $sup='matricule_sup='.$sonId
        ?>
        <script>
            if(confirm("Confirmer la suppression ?")){
                document.location.href = "traitement.php?title=traitement&<?php echo "$sup"; ?>"
            }
            else{
                document.location.href = "etudiants.php?title=Etudiants"
            }
        </script>
        <?php
    }
    require("footer.php");
?>