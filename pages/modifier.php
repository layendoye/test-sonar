 <?php require("haut_de_page.php");
if(!isset($_GET['matricule_info'])) header("location: etudiants.php?title=Etudiants");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>     
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
        <!-- Début formulaire -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <?php $matricule=$_GET['matricule_info'];?>
                <form <?php if(!isset($_GET['modif'])) echo 'action="modifier.php?title=Modification&matricule_info='.$matricule.'&modif=true"'; else{echo 'action="traitement.php?title=traitement&matricule_modif='.$matricule.'"';;}?> method="POST"> <?php $form=new Form($_POST);?>
                    <?php $info=false;
                    $etu=EtudiantService::info($_GET['matricule_info']);
                    if(!isset($_GET['modif'])) $info=true;
                    ?>
                    <!-- Début -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Nom','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','nom','form-control col-md-7 espace','Nom',$etu['Nom'],'',false,'',false,$info);?>
                    </div>
                    <!-- Fin -->

                    <!-- Début -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Prénom','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','prenom','form-control col-md-7 espace','Prénom',$etu['Prenom'],'',false,'',false,$info);?>
                    </div>
                    <!-- Fin -->

                    <!-- Début -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Naissance','col-md-2 espace pourLabel')?> 
                        <?php $form->input('date','naiss','form-control col-md-7 espace','',$etu['Naissance'],'',false,'',false,$info);?>
                    </div>
                    <!-- Fin -->

                    <!-- Début -->
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Email','col-md-2 espace pourLabel')?> 
                        <?php $form->input('email','email','form-control col-md-7 espace','Email',$etu['Email'],'',false,'',false,$info);?>
                    </div>
                    <!-- Fin -->

                    <!-- Début -->
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Téléphone','col-md-2 espace pourLabel')?> 
                        <?php $form->input('number','tel','form-control col-md-7 espace','Téléphone',$etu['Telephone'],'',false,'',false,$info);?>
                    </div>
                    <!-- Fin -->

                    <!-- Début -->
                    <?php if(isset($_GET['matricule_info'])) $statut=EtudiantService::checkStatut($_GET['matricule_info']);?> 
                    <?php if(isset($_GET['modif'])){?> 
                        <div class="row">
                            <div class=""></div>
                            <?php $form->label('','Non Boursier','col-md-3 espace pourLabel centrerDroite')?> 
                            <?php $form->input('radio','choix','form-control col-md-1 espace btRadio','','Non Boursier','nonBoursier','','afficherPourNonBoursier()');?>
                            <?php $form->label('','Boursier','col-md-2 espace pourLabel centrerDroite')?>
                            <?php $form->input('radio','choix','form-control col-md-1 espace btRadio','','Boursier','Boursier','','afficherPourBoursier()');?>
                            <?php $form->label('','Loger','col-md-2 espace pourLabel centrerDroite')?>
                            <?php $form->input('radio','choix','form-control col-md-1 espace btRadio','','Loger','Loger','','afficherPourLoge()');?>
                        </div>
                    <?php }?>
                    <!-- Fin -->

                    <!-- Début -->
                    <?php if(isset($_GET['matricule_info']) && $statut['Boursier']==true||isset($_GET['matricule_info']) && $statut['Loge']==true|| isset($_GET['modif'])){?> 
                        <div class="row" id='typeBourse'>
                            <div class="col-md-1"></div>
                            <?php $form->label('','Bourse','col-md-2 espace pourLabel')?>
                            <?php $tab_option=EtudiantService::find('Categorie_Bourse','Libelle');
                            $lib="";
                            if(isset($etu['Libelle'])) $lib=$etu['Libelle'];
                            $form->select($tab_option,'type_bour','form-control col-md-7 espace ' ,$lib,$info);
                            ?>
                        </div>
                    <?php }?>
                    <!-- Fin -->

                    <!-- Début -->
                    <?php if(isset($_GET['matricule_info']) && $statut['Loge']==true|| isset($_GET['modif'])){
                        $chambre='';
                        $nomBat='';
                        if(isset($etu['Numero_Ch'])) {
                            $nomBat=$etu['Nom_bat'];
                            $chambre=$etu['Numero_Ch'];
                        }?> 
                        
                        <div class="row" id='Chambre'>
                            <div class="col-md-1"></div>
                            <?php 
                            $form->label('','Chambre','col-md-2 espace pourLabel');?> 
                            <?php Affichage::selectChambre('chambre','form-control col-md-7 espace',$nomBat,$info);?> 
                        </div>
                    <?php }?>
                    <!-- Fin -->

                    <!-- Début -->
                    <?php if(isset($_GET['matricule_info']) && $statut['Boursier']==false|| isset($_GET['modif'])){
                        $adresse='';
                        if(isset($etu['Adresse'])) $adresse=$etu['Adresse'];
                            ?>
                        <div class="row" id='adresse'>
                            <div class="col-md-1"></div>
                        <?php $form->label('','Adresse','col-md-2 espace pourLabel');?> 
                            <?php $form->input('text','adresse','form-control col-md-7 espace','Adresse',$adresse,'',false,'',false,$info);?>
                        </div>
                    <?php }?>
                    <!-- Fin -->

                    <!-- Début -->
                    <div class="row">
                        <div class="col-md-4"></div>
                        <?php if(isset($_GET['modif'])) $nom_sub='Enregistrer'; else $nom_sub='Modifier';?>                        
                        <?php $form->submit('valider_modif_etudiant',$nom_sub,'form-control col-md-5 espace mb');?>
                    </div>
                </form>
                <?php //var_dump(EtudiantService::info($_GET['matricule_info']));?>
            </div>
        </div>
        <!-- Fin formulaire --> 
    </section>
</body>
<?php require("footer.php");?>