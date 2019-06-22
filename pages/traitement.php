<?php
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
            EtudiantService::delete('Categorie_Bourse','id_Categ_Bourse',$id_Categ);
        }
    }
    catch(PDOException $e){
        echo "ECHEC : " . $e->getMessage();
    }
?> 