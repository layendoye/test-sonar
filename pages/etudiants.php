<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>      
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
        <!-- Début formulaire -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                
                <form action="traitement.php?title=traitement" method="POST" id='MonForm'> 
                <?php if(isset($_SESSION['donnees_etudiants'])) $form=new Form($_SESSION['donnees_etudiants']); else $form=new Form();?>
                <?php ?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Nom','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','nom','form-control col-md-7 espace','Nom','','',true);?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Prénom','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','prenom','form-control col-md-7 espace','Prénom','','',true);?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Naissance','col-md-2 espace pourLabel')?> 
                        <?php $form->input('date','naiss','form-control col-md-7 espace','','','',true);?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Email','col-md-2 espace pourLabel')?> 
                        <?php $form->input('email','email','form-control col-md-7 espace','Email','','',true);?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Téléphone','col-md-2 espace pourLabel')?> 
                        <?php $form->input('number','tel','form-control col-md-7 espace','Téléphone','','',true);?>
                    </div>
                    <div class="row">
                        <div class=""></div>
                        <?php
                        $checked='';
                        if (isset($_SESSION['donnees_etudiants']['choix']) && $_SESSION['donnees_etudiants']['choix']=='Loger') $checked='" checked ';
                        ?>
                        <div class="col-3"></div>
                        <?php $form->input('radio','choix','espace btRadio ','','Non Boursier','nonBoursier','','afficherPourNonBoursier()');?>
                        <?php $form->label('','Non Boursier','espace pourLabel centrerDroite')?> 
                        <div class="col-1"></div>
                        <?php $form->input('radio','choix','espace btRadio','','Boursier','Boursier','','afficherPourBoursier()');?>
                        <?php $form->label('','Boursier','espace pourLabel centrerDroite ')?>
                        <div class="col-1"></div>
                        <?php $form->input('radio','choix','espace btRadio '.$checked,'','Loger','Loger','','afficherPourLoge()');?>
                        <?php $form->label('','Loger','espace pourLabel centrerDroite')?>
                    </div>
                    <div class="row" id='typeBourse'>
                        <div class="col-md-1"></div>
                       <?php $form->label('','Bourse','col-md-2 espace pourLabel')?>
                        <?php $tab_option=EtudiantService::find('Categorie_Bourse','Libelle');
                        $form->select($tab_option,'type_bour','form-control col-md-7 espace');?>
                    </div>
                    <div class="row" id='Batiment'>
                        <div class="col-md-1"></div>
                        <?php $form->label('','Batiment','col-md-2 espace pourLabel')?>
                        <?php if(isset($_SESSION['donnees_etudiants']['Batiment'])) $cocher=$_SESSION['donnees_etudiants']['Batiment']; else $cocher='';?>
                       <?php Affichage::selectBat('Batiment','form-control col-md-7 espace',$cocher)?> 
                    </div>
                    <?php if(isset($_SESSION['donnees_etudiants']['Batiment']) && $_SESSION['donnees_etudiants']['choix']=='Loger'){?>
                    <div class="row" id='Chambre'>
                        <div class="col-md-1"></div>
                        <?php $form->label('','Chambre','col-md-2 espace pourLabel')?> 
                       <?php Affichage::selectChambre('chambre','form-control col-md-7 espace',$_SESSION['donnees_etudiants']['Batiment']);?> 
                    </div>
                    <?php }?>
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
        <div class="Mes_tableaux">
            <?php
            $titres=array('Matricule','Nom','Prenom','Naissance','Email','Telephone','Statut','Modifier','Supprimer');
            $etudiants=EtudiantService::find('Etudiants');
            Affichage::tableau_etu($titres,$etudiants,'display nowrap');
            ?>
        </div>
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