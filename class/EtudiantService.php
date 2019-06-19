<?php
namespace AN;
class EtudiantService {
    protected $connexion;
    protected $les_categ_Bourse;
    public function __construct($nom_bdd){
        if($this->connexion==null){//si la base de données n est pas deja ouvert on l'ouvre
            $this->connexion=new Bdd($nom_bdd);
        }
    }
   
    public function add($nom,$prenom, $naissance, $email, $telephone, $id_Statut='NBNL'){
        $donnee_etudiants=$this->findAll();
        $matricule=$donnee_etudiants[count($donnee_etudiants)-1]->Matricule;//recupere le dernier matricule
        $matricule=str_replace('ETD ','',$matricule);//on remplace le ETD par du vide
        $matricule+=1;//on incremente
        $matricule='ETD '.$matricule;//on reaffecte le bon matricule

        $codemysql = "INSERT INTO `Etudiants` (Matricule,Nom,Prenom,Naissance,Email,Telephone)
                            VALUES(:Matricule,:Nom,:Prenom,:Naissance,:Email,:Telephone)"; //le code mysql
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
        $requete->execute(); //excecute la requete qui a été preparé
    }
    public function addBoursier($matricule,$categorie_Bourse){
        $connexion=($this->connexion);
        $matricule=$connexion->securisation($matricule);
        $categorie_Bourse=$connexion->securisation($categorie_Bourse);
       
        $codemysql = "INSERT INTO `Boursiers` (Matricule,id_Categ_Bourse)
                           VALUES(:Matricule,:id_Categ_Bourse)"; //le code mysql
        
        $requete = ($connexion->getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":id_Categ_Bourse", $categorie_Bourse);
        $requete->execute(); //excecute la requete qui a été preparé
    }
    public function addLoge($matricule,$id_Logement){
        $connexion=($this->connexion);
        $matricule=$connexion->securisation($matricule);
        $id_Logement=$connexion->securisation($id_Logement);
       
        $codemysql = "INSERT INTO `Loges` (Matricule,id_Logement)
                           VALUES(:Matricule,:id_Logement)"; //le code mysql
        
        $requete = ($connexion->getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":id_Logement", $id_Logement);
        $requete->execute(); //excecute la requete qui a été preparé
    }
    public function findAll(){
        $codesql='SELECT * FROM Etudiants';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
    public function find($matricule){
        $donnee_etudiants=$this->findAll();
        for($i=0;$i<count($donnee_etudiants);$i++){
            if($matricule==$donnee_etudiants[$i]->Matricule){
                return $donnee_etudiants[$i];
            }
        }
        return null;
    }
    public function find_indice($i){
        $donnee_etudiants=$this->findAll();
        if($i>=0 && $i<count($donnee_etudiants)){
            return $donnee_etudiants[$i];
        }
        return null;
    }
    public function findAllBoursiers(){
        $codesql='SELECT * FROM Boursiers';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
    public function findBousier($matricule){
        $donnee_etudiants=$this->findAllBoursiers();
        for($i=0;$i<count($donnee_etudiants);$i++){
            if($matricule==$donnee_etudiants[$i]->Matricule){
                return $donnee_etudiants[$i];
            }
        }
        return null;
    }
    public function findAllLoges(){
        $codesql='SELECT * FROM Loges';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
    function findLoges($matricule){
        $donnee_etudiants=$this->findAllLoges();
        for($i=0;$i<count($donnee_etudiants);$i++){
            if($matricule==$donnee_etudiants[$i]->Matricule){
                return $donnee_etudiants[$i];
            }
        }
        return null;
    }
    public function findNonBousier($matricule){
        $donnee_etudiants=$this->findAll();
        for($i=0;$i<count($donnee_etudiants);$i++){
            if($matricule==$donnee_etudiants[$i]->Matricule && $donnee_etudiants[$i]->id_Statut=='NBNL'){
                return $donnee_etudiants[$i];
            }
        }
        return null;
    }
    public function findAllCategorie_Bourse(){
        $codesql='SELECT * FROM Categorie_Bourse';
        $this->les_categ_Bourse = ($this->connexion)->recuperation($codesql);
        return $this->les_categ_Bourse;
    }
    public function findCategorie_Bourse($id_Categ_Bourse){
        $this->findAllCategorie_Bourse();
        for($i=0;$i<count($this->les_categ_Bourse);$i++){
            if($this->les_categ_Bourse[$i]->id_Categ_Bourse==$id_Categ_Bourse){
                return $this->les_categ_Bourse[$i];
            }
        }
        return null;
    }
    public function findAllLogement(){
        $codesql='SELECT * FROM Logement';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
    public function findAllChambres(){
        $codesql='SELECT * FROM Chambres';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
    public function findAllBatiment(){
        $codesql='SELECT * FROM Batiment';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
    public function findAllNonLoges(){
        $codesql='SELECT * FROM Non_Loges';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
    public function checkStatut($matricule){
        $boursier=false;
        $loge=false;
        if($this->findBousier($matricule)!=null)
            $boursier=true;
        if($this->findLoges($matricule)!=null)
            $loge=true;        
        
        return array('Boursier'=>$boursier,'Loge'=>$loge);
    }

}