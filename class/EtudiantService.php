<?php
class EtudiantService {
    
    ////////////////------morcelement de l'ajout-----//////////////////
    private static function addBoursier($matricule,$Libelle_categ_Bourse){
       
        $matricule=Validation::securisation($matricule);
        $Libelle_categ_Bourse=Validation::securisation($Libelle_categ_Bourse);
        $id_categorie=self::findId_Categorie_Bourse($Libelle_categ_Bourse);//retourne l'id de la categorie
        $codemysql = "INSERT INTO `Boursiers` (Matricule,id_Categ_Bourse)
                           VALUES(:Matricule,:id_Categ_Bourse)"; //le code mysql
        
        $requete = (Bdd::getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":id_Categ_Bourse", $id_categorie);
        $requete->execute(); //excecute la requete qui a été preparé
    }
    private static function addLoge($matricule,$id_Chambre){
       
        $matricule=Validation::securisation($matricule);
        $id_Chambre=Validation::securisation($id_Chambre);
       
        $codemysql = "INSERT INTO `Loges` (Matricule,id_Chambre)
                           VALUES(:Matricule,:id_Chambre)"; //le code mysql
        
        $requete = (Bdd::getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":id_Chambre", $id_Chambre);
        $requete->execute(); //excecute la requete qui a été preparé
    }
    private static function addNonLoge($matricule,$adress){
       
        $matricule=Validation::securisation($matricule);
        $adress=Validation::securisation($adress);
       
        $codemysql = "INSERT INTO `Non_Loges` (Matricule,Adresse)
                           VALUES(:Matricule,:Adresse)"; //le code mysql
        
        $requete = (Bdd::getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":Adresse", $adress);
        $requete->execute(); //excecute la requete qui a été preparé
    }
    ////////////////------Fin morcelement de l'ajout-----//////////////////

    public static function add(Etudiants $etudiant){
        $donnee_etudiants=self::find('Etudiants');
        if(count($donnee_etudiants)>0){
            $matricule=$donnee_etudiants[count($donnee_etudiants)-1]->Matricule;//recupere le dernier matricule
            $matricule+=1;//on incremente
        }
        else
            $matricule=1;//le 1er

        $codemysql = "INSERT INTO `Etudiants` (Matricule,Nom,Prenom,Naissance,Email,Telephone)
                            VALUES(:Matricule,:Nom,:Prenom,:Naissance,:Email,:Telephone)"; //le code mysql
       
        $nom=Validation::securisation($etudiant->getNom());
        $prenom=Validation::securisation($etudiant->getPrenom());
        $naissance=Validation::securisation($etudiant->getNaissance());
        $telephone=Validation::securisation($etudiant->getTelephone());
        $email=Validation::securisation($etudiant->getEmail());
        
        $requete = (Bdd::getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":Matricule", $matricule);
        $requete->bindParam(":Nom", $nom);
        $requete->bindParam(":Prenom", $prenom);
        $requete->bindParam(":Naissance", $naissance);
        $requete->bindParam(":Telephone", $telephone);
        $requete->bindParam(":Email", $email);
        $requete->execute(); //excecute la requete qui a été preparé
        if(get_class($etudiant)=='Boursiers'){
            self::addBoursier($matricule,$etudiant->getLibelle_categ_Bourse());
        }
        elseif(get_class($etudiant)=='Loges'){
            self::addBoursier($matricule,$etudiant->getLibelle_categ_Bourse());
            self::addLoge($matricule,$etudiant->getId_Chambre());
        }
        elseif(get_class($etudiant)=='Non_Boursiers'){
            self:: addNonLoge($matricule,$etudiant->getAdresse());
        }
    }
    public static function find($table,$element='*',$colonne='0',$valeur='0'){//0=0 renvoi true donc si on ne rempli pas les champ il va tout afficher
        $codesql="SELECT $element FROM $table WHERE $colonne='$valeur'";
        $donnees_des_etudiants = Bdd::recuperation($codesql);
        return $donnees_des_etudiants;
    }
    public static function find_indice($i,$table){
        $donnee_etudiants=self::find($table);
        if($i>=0 && $i<count($donnee_etudiants)){
            return $donnee_etudiants[$i];
        }
        return null;
    }
    public static function findId_Categorie_Bourse($Libelle){
        $les_categ_Bourse=self::find('Categorie_Bourse');
        for($i=0;$i<count($les_categ_Bourse);$i++){
            if($les_categ_Bourse[$i]->Libelle==$Libelle){
                return $les_categ_Bourse[$i]->id_Categ_Bourse;
            }
        }
        return null;
    }
    public static function checkStatut($matricule){
        $boursier=false;
        $loge=false;
        if(self::find('Boursiers','Matricule',$matricule)!=null)
            $boursier=true;
        if(self::find('Loges','Matricule',$matricule)!=null)
            $loge=true;        
        
        return array('Boursier'=>$boursier,'Loge'=>$loge);
    }
}