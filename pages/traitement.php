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
        if($_POST['valider_modif_etudiant']){
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
    }
    catch(PDOException $e){
        echo "ECHEC : " . $e->getMessage();
    }
?> 