<?php
class EtudiantService {
    protected $connexion;
    
    public function __construct(){
        if($this->connexion==null){//si la base de données n est pas deja ouvert on l'ouvre
            $this->connexion=new Bdd('Universite');
        }
    }
   
    public function add(Etudiants $etudiant){
        $donnee_etudiants=$this->findAll('Etudiants');
        if(count($donnee_etudiants)>0){
            $matricule=$donnee_etudiants[count($donnee_etudiants)-1]->Matricule;//recupere le dernier matricule
            $matricule=str_replace(' ETD','',$matricule);//on remplace le ETD par du vide
            $matricule+=1;//on incremente
        }
        else
            $matricule=1;//le 1er
        $matricule=$matricule.' ETD';//on reaffecte le bon matricule

        $codemysql = "INSERT INTO `Etudiants` (Matricule,Nom,Prenom,Naissance,Email,Telephone)
                            VALUES(:Matricule,:Nom,:Prenom,:Naissance,:Email,:Telephone)"; //le code mysql
        $connexion=($this->connexion);
        
        $nom=Validation::securisation($etudiant->getNom());
        $prenom=Validation::securisation($etudiant->getPrenom());
        $naissance=Validation::securisation($etudiant->getNaissance());
        $telephone=Validation::securisation($etudiant->getTelephone());
        $email=Validation::securisation($etudiant->getEmail());
        
        $requete = ($connexion->getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":Nom", $nom);
        $requete->bindParam(":Prenom", $prenom);
        $requete->bindParam(":Naissance", $naissance);
        $requete->bindParam(":Telephone", $telephone);
        $requete->bindParam(":Email", $email);
        $requete->execute(); //excecute la requete qui a été preparé
        if(get_class($etudiant)=='Boursiers'){
            $this->addBoursier($matricule,$etudiant->getLibelle_categ_Bourse());
        }
        elseif(get_class($etudiant)=='Loges'){
            $this->addBoursier($matricule,$etudiant->getLibelle_categ_Bourse());
            $this->addLoge($matricule,$etudiant->getId_Chambre());
        }
        elseif(get_class($etudiant)=='NonLoges'){
            $this-> addNonLoge($matricule,$etudiant->getAdresse());
        }
    }

    private function addBoursier($matricule,$Libelle_categ_Bourse){
        $connexion=($this->connexion);
        $matricule=Validation::securisation($matricule);
        $Libelle_categ_Bourse=Validation::securisation($Libelle_categ_Bourse);
        $id_categorie=$this->findId_Categorie_Bourse($Libelle_categ_Bourse);//retourne l'id de la categorie
        $codemysql = "INSERT INTO `Boursiers` (Matricule,id_Categ_Bourse)
                           VALUES(:Matricule,:id_Categ_Bourse)"; //le code mysql
        
        $requete = ($connexion->getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":id_Categ_Bourse", $id_categorie);
        $requete->execute(); //excecute la requete qui a été preparé
    }
    private function addLoge($matricule,$id_Chambre){
        $connexion=($this->connexion);
        $matricule=Validation::securisation($matricule);
        $id_Chambre=Validation::securisation($id_Chambre);
       
        $codemysql = "INSERT INTO `Loges` (Matricule,id_Chambre)
                           VALUES(:Matricule,:id_Chambre)"; //le code mysql
        
        $requete = ($connexion->getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":id_Chambre", $id_Chambre);
        $requete->execute(); //excecute la requete qui a été preparé
    }
    private function addNonLoge($matricule,$adress){
        $connexion=($this->connexion);
        $matricule=Validation::securisation($matricule);
        $adress=Validation::securisation($adress);
       
        $codemysql = "INSERT INTO `Non_Loges` (Matricule,Adresse)
                           VALUES(:Matricule,:Adresse)"; //le code mysql
        
        $requete = ($connexion->getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":Adresse", $adress);
        $requete->execute(); //excecute la requete qui a été preparé
    }
    public function findAll($table){
        $codesql='SELECT * FROM '.$table;
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
    public function find($matricule,$table){
        $donnee_etudiants=$this->findAll($table);
        for($i=0;$i<count($donnee_etudiants);$i++){
            if($matricule==$donnee_etudiants[$i]->Matricule){
                return $donnee_etudiants[$i];
            }
        }
        return null;
    }
    public function find_indice($i,$table){
        $donnee_etudiants=$this->findAll($table);
        if($i>=0 && $i<count($donnee_etudiants)){
            return $donnee_etudiants[$i];
        }
        return null;
    }
    public function findCategorie_Bourse($id_Categ_Bourse){
        $les_categ_Bourse=$this->findAll('Categorie_Bourse');
        for($i=0;$i<count($les_categ_Bourse);$i++){
            if($les_categ_Bourse[$i]->id_Categ_Bourse==$id_Categ_Bourse){
                return $les_categ_Bourse[$i];
            }
        }
        return null;
    }
    public function findId_Categorie_Bourse($Libelle){
        $les_categ_Bourse=$this->findAll('Categorie_Bourse');
        for($i=0;$i<count($les_categ_Bourse);$i++){
            if($les_categ_Bourse[$i]->Libelle==$Libelle){
                return $les_categ_Bourse[$i]->id_Categ_Bourse;
            }
        }
        return null;
    }
    public function checkStatut($matricule){
        $boursier=false;
        $loge=false;
        if($this->find($matricule,'Boursiers')!=null)
            $boursier=true;
        if($this->find($matricule,'Loges')!=null)
            $loge=true;        
        
        return array('Boursier'=>$boursier,'Loge'=>$loge);
    }

}