<?php
require("../class/Autoloader.php");
Autoloader::register();
Bdd::connexion('Universite');
    try{
        if(isset($_POST['valider_ajout_etudiant'])){
            if($_POST['type_bour']!='' && $_POST['chambre']=='' && $_POST['adresse']==''){//un simple boursier
                $etudiant=new Boursier('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour']);
            }
            elseif($_POST['type_bour']!='' && $_POST['chambre']!='' && $_POST['adresse']==''){//boursier et logé
                $etudiant=new Loges('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour'],$_POST['chambre']);
            }
            else{//non boursier{
                $etudiant=new Non_Boursiers('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['adresse']);
            }
            EtudiantService::add($etudiant);
            header("location: etudiants.php?title=Etudiants");
        }
    }
    catch(PDOException $e){
        echo "ECHEC : " . $e->getMessage();
    }
?> 