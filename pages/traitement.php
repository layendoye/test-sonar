<?php
session_start();
require("../class/Autoloader.php");
Autoloader::register();
Bdd::connexion('Universite');
    try{
        if(isset($_POST['valider_ajout_etudiant'])){
            if($_POST['choix']=='Boursier'){//un simple boursier
                $etudiant=new Boursiers('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour']);
            }
            elseif($_POST['choix']=='Loger'){//boursier et logé
                $etudiant=new Loges('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour'],$_POST['chambre']);
            }
            elseif($_POST['choix']=='Non Boursier'){//non boursier{
                $etudiant=new Non_Boursiers('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['adresse']);
            }
            EtudiantService::add($etudiant);
            header("location: etudiants.php?title=Etudiants");
        }
        if(isset($_POST['valider_modif_etudiant'])){
            if($_POST['choix']=='Boursier'){//un simple boursier
                $etudiant=new Boursiers($_GET['matricule_modif'],$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour']);
            }
            elseif($_POST['choix']=='Loger'){//boursier et logé
                $etudiant=new Loges($_GET['matricule_modif'],$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour'],$_POST['chambre']);
            }
            elseif($_POST['choix']=='Non Boursier'){//non boursier{
                $etudiant=new Non_Boursiers($_GET['matricule_modif'],$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['adresse']);
            }
            EtudiantService::update($etudiant);
            header("location: modifier.php?title=Modification&matricule_info=".$_GET['matricule_modif']);
        }
        if(isset($_GET['matricule_sup'])){
            $matricule=$_GET['matricule_sup'];
            if(EtudiantService::find('Non_Boursiers','Matricule','Matricule',$matricule)!=null) EtudiantService::delete('Non_Boursiers','Matricule',$matricule);
            if(EtudiantService::find('Loges','Matricule','Matricule',$matricule)!=null) EtudiantService::delete('Loges','Matricule',$matricule);
            if(EtudiantService::find('Boursiers','Matricule','Matricule',$matricule)!=null) EtudiantService::delete('Boursiers','Matricule',$matricule);
            EtudiantService::delete('Etudiants','Matricule',$matricule);
            header("location: etudiants.php?title=Etudiants");
        }
        if(isset($_GET['id_Categ_Bourse_sup'])){
            $id_Categ=$_GET['id_Categ_Bourse_sup'];
            $dejaMigrer=false;
            if(EtudiantService::find('Boursiers','id_Categ_Bourse','id_Categ_Bourse',$id_Categ)!=null) $dejaMigrer=true;
            if($dejaMigrer==false){
                EtudiantService::delete('Categorie_Bourse','id_Categ_Bourse',$id_Categ);
                header("location: bourses.php?title=Bourses");
            }
            else{
                header("location: bourses.php?title=Bourses&dejaMigrer=true");
            }
        }
        if(isset($_POST['valider_ajout_bourse'])){
            $existe=false;
            if(EtudiantService::find('Categorie_Bourse','Libelle','Libelle',$_POST['Libelle'])!=null) $existe=true;
            if($existe==false){
                $categorie=new Categorie_Bourse('',$_POST['Libelle'],$_POST['Montant']);
                EtudiantService::addCategorie_Bourse($categorie);
                header("location: bourses.php?title=Bourses");
            }
            else{
                $_SESSION['donnees']=$_POST;
                header("location: bourses.php?title=Bourses&existe=true");
            }
        }
        if(isset($_POST['valider_mod_bourse'])){
             $existe=false;
            if($lib=EtudiantService::find('Categorie_Bourse','Libelle','Libelle',$_POST['Libelle'])[0]->Libelle){
                if(EtudiantService::find('Categorie_Bourse','Libelle','id_Categ_Bourse',$_SESSION['id_Categ_Bourse_mod'])[0]->Libelle!=$lib)
                $existe=true;
            }
            if($existe==false){
                $categorie=new Categorie_Bourse('',$_POST['Libelle'],$_POST['Montant']);
                EtudiantService::updateTable('Categorie_Bourse',$_POST['Libelle'],$_POST['Montant'],'Libelle','Montant','id_Categ_Bourse',$_SESSION['id_Categ_Bourse_mod']);
                header("location: bourses.php?title=Bourses");
            }
            else{
                $_SESSION['donnees']=$_POST;
                header("location: bourses.php?title=Bourses&existe=true");
            }
            
        }
        if(isset($_POST['valider_ajout_ch'])){
            $existe=false;
            $id_bat='';
            $id_bat=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$_POST['Batiment'])[0]->id_Batiment;
            if(EtudiantService::find('Chambres','id_Chambre','Numero_Ch',$_POST['chambre']."') AND UPPER(id_Batiment) = UPPER('$id_bat")!=null) $existe=true;//Modification de la fonction find (addaptation)
            if($existe==false){
                $id_bat=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$_POST['Batiment'])[0]->id_Batiment;
                EtudiantService::addTable('Chambres',$_POST['chambre'],$id_bat,'Numero_Ch','id_Batiment');
                header("location: chambres.php?title=Chambres");
            }
            else{
                $_SESSION['donnees_ch']=$_POST;
                header("location: chambres.php?title=Chambres&existe=true");
            }
        }
        if(isset($_POST['valider_modif_ch'])){
            $existe=false;
            $id_bat='';
            $id_bat=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$_POST['Batiment'])[0]->id_Batiment;
            if(EtudiantService::find('Chambres','id_Chambre','Numero_Ch',$_POST['chambre']."') AND UPPER(id_Batiment) = UPPER('$id_bat")!=null) $existe=true;
            
            if($existe==false){
                $id_bat=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$_POST['Batiment'])[0]->id_Batiment;
                EtudiantService::updateTable('Chambres',$_POST['chambre'],$id_bat,'Numero_Ch','id_Batiment','id_Chambre',$_SESSION['id_Chambre']);
                header("location: chambres.php?title=Chambres");
            }
            else{
                $_SESSION['donnees_ch']=$_POST;
                header("location: chambres.php?title=Chambres&existe=true&mod=true");
            }
        }
        if(isset($_GET['id_Chambre_sup'])){
            $id_Ch=$_GET['id_Chambre_sup'];
            $dejaMigrer=false;
            if(EtudiantService::find('Loges','id_Chambre','id_Chambre',$id_Ch)!=null) $dejaMigrer=true;
            if($dejaMigrer==false){
                EtudiantService::delete('Chambres','id_Chambre',$id_Ch);
                header("location: chambres.php?title=Chambres");
            }
            else{
                header("location: chambres.php?title=Chambres&dejaMigrer=true");
            }
        }
    }
    catch(PDOException $e){
        echo "ECHEC : " . $e->getMessage();
    }
?> 