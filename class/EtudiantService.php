<?php
namespace AN;
class EtudiantService extends Boursiers{
    
    public function add($nom,$prenom, $naissance, $email, $telephone, $id_Statut='NBNL'){
        $donnee_etudiants=$this->findAll();
        $matricule=$donnee_etudiants[count($donnee_etudiants)-1]->Matricule;//recupere le dernier matricule
        $matricule=str_replace('ETD ','',$matricule);//on remplace le ETD par du vide
        $matricule+=1;//on incremente
        $matricule='ETD '.$matricule;//on reaffecte le bon matricule

        $codemysql = "INSERT INTO `Etudiants` (Matricule,Nom,Prenom,Naissance,Email,Telephone,id_Statut)
                            VALUES(:Matricule,:Nom,:Prenom,:Naissance,:Email,:Telephone,:id_Statut)"; //le code mysql
        $connexion=($this->connexion);
        
        $nom=$connexion->securisation($nom);
        $prenom=$connexion->securisation($prenom);
        $naissance=$connexion->securisation($naissance);
        $telephone=$connexion->securisation($telephone);
        $email=$connexion->securisation($email);
        $id_Statut=$connexion->securisation($id_Statut);

        $requete = ($connexion->getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":Nom", $nom);
        $requete->bindParam(":Prenom", $prenom);
        $requete->bindParam(":Naissance", $naissance);
        $requete->bindParam(":Telephone", $telephone);
        $requete->bindParam(":Email", $email);
        $requete->bindParam(":id_Statut", $id_Statut);
        $requete->execute(); //excecute la requete qui a été preparé
    }

    public function find($matricule){
        $donnee_etudiants=$this->findAll();
        for($i=0;$i<count($donnee_etudiants);$i++){
            if($matricule==$donnee_etudiants[$i]->Matricule){
                return $donnee_etudiants[$i];
            }
        }
    }
    public function findBousier($matricule){
        $donnee_etudiants=$this->findAll();
        for($i=0;$i<count($donnee_etudiants);$i++){
            if($matricule==$donnee_etudiants[$i]->Matricule && $donnee_etudiants[$i]->id_Statut=='BL'|| $matricule==$donnee_etudiants[$i]->Matricule && $donnee_etudiants[$i]->id_Statut=='BNL'){
                return $donnee_etudiants[$i];
            }
        }
    }
    
    public function findAllBoursiers(){
        $codesql='SELECT * FROM Boursiers';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }

    public function findNonBousier($matricule){
        $donnee_etudiants=$this->findAll();
        for($i=0;$i<count($donnee_etudiants);$i++){
            if($matricule==$donnee_etudiants[$i]->Matricule && $donnee_etudiants[$i]->id_Statut=='NBNL'){
                return $donnee_etudiants[$i];
            }
        }
    }

}