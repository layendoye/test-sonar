<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>
<?php if(isset($_SESSION['donnees_etudiants']) && !isset($_GET['ChoiCh'])) unset($_SESSION['donnees_etudiants']);?>      
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
        <!-- Début formulaire -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <?php if(isset($_GET['matricule_modif'])) $etu=EtudiantService::info($_GET['matricule_modif']);?>
                <form action="traitement.php?title=traitement" method="POST" id='MonForm'> 
                    <?php if(isset($_SESSION['donnees_etudiants']) && $_GET['ChoiCh']==true) $form=new Form($_SESSION['donnees_etudiants']); else $form=new Form();?>
                    
                    <?php /////////////////--------------------Début Nom------------------///////////////////////////?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Nom','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['matricule_modif'])) {$form->input('text','nom','form-control col-md-7 espace','Nom','','',true);?>
                        <?php }else $form->input('text','nom','form-control col-md-7 espace','Nom',$etu['Nom'],'',false,'',false);?>
                    </div>
                    <?php /////////////////--------------------Fin Nom------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début Prenom------------------///////////////////////////?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Prénom','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['matricule_modif'])) {$form->input('text','prenom','form-control col-md-7 espace','Prénom','','',true);?>
                        <?php }else $form->input('text','prenom','form-control col-md-7 espace','Prénom',$etu['Prenom'],'',false,'',false);?>
                    </div>
                    <?php /////////////////--------------------Fin Prenom------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début Naissance------------------///////////////////////////?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Naissance','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['matricule_modif'])) {$form->input('date','naiss','form-control col-md-7 espace','','','',true);?>
                        <?php }else $form->input('date','naiss','form-control col-md-7 espace','',$etu['Naissance'],'',false,'',false);?>
                    </div>
                    <?php /////////////////--------------------Fin Naissance------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début Email------------------///////////////////////////?>
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Email','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['matricule_modif'])) {$form->input('email','email','form-control col-md-7 espace','Email','','',true);?>
                        <?php }else $form->input('email','email','form-control col-md-7 espace','Email',$etu['Email'],'',false,'',false);?>
                    </div>
                    <?php /////////////////--------------------Fin Email------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début ------------------///////////////////////////?>
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Téléphone','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['matricule_modif'])) {$form->input('number','tel','form-control col-md-7 espace','Téléphone','','',true);?>
                        <?php }else $form->input('number','tel','form-control col-md-7 espace','Téléphone',$etu['Telephone'],'',false,'',false);?>
                    </div>
                    <?php /////////////////--------------------Fin ------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début Choix statut------------------///////////////////////////?>
                    <div class="row" <?php if(isset($_GET['Statut_et'])) echo 'id="Statut '.$_GET['Statut_et'].'"'; //pour afficher les éléments correspondant au statut avec js?>>
                        <?php
                            $checked1=$checked2=$checked3='';
                            if (isset($_SESSION['donnees_etudiants']['choix']) && $_SESSION['donnees_etudiants']['choix']=='Loger' && !isset($_GET['matricule_modif'])) $checked3='" checked ';
                            if(isset($_GET['matricule_modif'])){
                                if($etu['Statut']['Boursier']) $checked2='" checked ';
                                elseif($etu['Statut']['Loge']) $checked3='" checked ';
                                else  $checked1='" checked ';
                            }
                        ?>
                        <div class="col-3"></div>
                        <?php $form->input('radio','choix','espace btRadio '.$checked1,'','Non Boursier','nonBoursier','','afficherPourNonBoursier()');?>
                        <?php $form->label('','Non Boursier','espace pourLabel centrerDroite')?> 
                        <div class="col-1"></div>
                        <?php $form->input('radio','choix','espace btRadio'.$checked2,'','Boursier','Boursier','','afficherPourBoursier()');?>
                        <?php $form->label('','Boursier','espace pourLabel centrerDroite ')?>
                        <div class="col-1"></div>
                        <?php $form->input('radio','choix','espace btRadio '.$checked3,'','Loger','Loger','','afficherPourLoge()');?>
                        <?php $form->label('','Loger','espace pourLabel centrerDroite')?>
                    </div>
                    <?php /////////////////--------------------Fin Choix statut------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début type de bourse------------------///////////////////////////?>
                    <div class="row" id='typeBourse'>
                        <div class="col-md-1"></div>
                       <?php $form->label('','Bourse','col-md-2 espace pourLabel')?>
                        <?php $tab_option=EtudiantService::find('Categorie_Bourse','Libelle');
                        if(!isset($_GET['matricule_modif'])) {$form->select($tab_option,'type_bour','form-control col-md-7 espace');?>
                        <?php }else{
                            $lib="";
                            if(isset($etu['Libelle'])) $lib=$etu['Libelle'];
                            $form->select($tab_option,'type_bour','form-control col-md-7 espace ' ,$lib);
                        }?>
                    </div>
                    <?php /////////////////--------------------Fin type de bourse------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début Batiment------------------///////////////////////////?>
                    <div class="row" id='Batiment'>
                        <div class="col-md-1"></div>
                        <?php $form->label('','Batiment','col-md-2 espace pourLabel')?>
                        <?php 
                            if(isset($_SESSION['donnees_etudiants']['Batiment']) && !isset($_GET['matricule_modif'])) $cocher=$_SESSION['donnees_etudiants']['Batiment']; 
                            elseif(isset($_GET['matricule_modif']) && isset($etu['id_Batiment'])) $cocher=$etu['id_Batiment'];
                            else $cocher='';
                        ?>
                        <?php Affichage::selectBat('Batiment','form-control col-md-7 espace',$cocher)?> 
                    </div>
                    <?php /////////////////--------------------Fin Batiment------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début Chambre------------------///////////////////////////?>
                    <?php if(isset($_SESSION['donnees_etudiants']['Batiment']) && $_SESSION['donnees_etudiants']['choix']=='Loger' || isset($_GET['matricule_modif']) && isset($etu['id_Batiment'])){?>
                        <div class="row" id='Chambre'>
                            <div class="col-md-1"></div>
                            <?php if(!isset($_GET['matricule_modif']) || isset($_GET['matricule_modif']) && isset($etu['id_Batiment'])) $form->label('','Chambre','col-md-2 espace pourLabel');?> 
                            <?php if(!isset($_GET['matricule_modif'])) {Affichage::selectChambre('chambre','form-control col-md-7 espace',$_SESSION['donnees_etudiants']['Batiment']);?>
                            <?php }elseif(isset($etu['id_Batiment'])) Affichage::selectChambre('chambre','form-control col-md-7 espace',$etu['id_Batiment'],$etu['id_Chambre']);?>
                        </div>
                    <?php }?>
                    <?php /////////////////--------------------Fin Chambre------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début Adresse------------------///////////////////////////?>
                    <div class="row" id='adresse'>
                        <div class="col-md-1"></div>
                       <?php $form->label('','Adresse','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['matricule_modif']) || isset($_GET['matricule_modif'])&& !isset($etu['Adresse'])) {$form->input('text','adresse','form-control col-md-7 espace','Adresse');?>
                        <?php }elseif(isset($etu['Adresse'])) $form->input('text','adresse','form-control col-md-7 espace','Adresse',$etu['Adresse'],'',false,'',false);?>
                    </div>
                    <?php /////////////////--------------------Fin Adresse------------------///////////////////////////?>
                    
                    <?php /////////////////--------------------Début submit------------------///////////////////////////?>
                    <div class="row">
                        <div class="col-md-4"></div>                        
                        <?php if(!isset($_GET['matricule_modif']) ) {$form->submit('valider_ajout_etudiant','Enregistrer','form-control col-md-5 espace mb');?>
                        <?php }else $form->submit('valider_modif_etudiant','Modifier','form-control col-md-5 espace mb');?>
                    </div>
                    <?php /////////////////--------------------Fin submit------------------///////////////////////////?>

                </form>
            </div>
        </div>
        <!-- Fin formulaire -->

        <!-- Début tableau -->
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
    ///////////-----Début validation suppression---////////
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
    ///////////-----Fin validation suppression---////////
    
    require("footer.php");
?>