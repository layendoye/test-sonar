<?php
class EtudiantService {
    
    private static function addTable($table,$valeur1,$valeur2,$Nomcol_valeur1,$Nomcol_valeur2){
       
        $valeur1=Validation::securisation($valeur1);
        $valeur2=Validation::securisation($valeur2);
        if($table=='Boursiers') //on recupere l'id
            $valeur2=self::findId_Categorie_Bourse($valeur2);
        
        $codemysql = "INSERT INTO `$table` ($Nomcol_valeur1,$Nomcol_valeur2)
                           VALUES(:$Nomcol_valeur1,:$Nomcol_valeur2)"; //le code mysql
        
        $requete = (Bdd::getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->bindParam(":$Nomcol_valeur1", $valeur1);
        $requete->bindParam(":$Nomcol_valeur2", $valeur2);
        $requete->execute(); //excecute la requete qui a été preparé
    }
  
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
            self::addTable('Boursiers',$matricule,$etudiant->getLibelle_categ_Bourse(),'Matricule','id_Categ_Bourse');
        }
        elseif(get_class($etudiant)=='Loges'){
            self::addTable('Boursiers',$matricule,$etudiant->getLibelle_categ_Bourse(),'Matricule','id_Categ_Bourse');
            self::addTable('Loges',$matricule,$etudiant->getId_Chambre(),'Matricule','id_Chambre');
        }
        elseif(get_class($etudiant)=='Non_Boursiers'){
            self::addTable('Non_Boursiers',$matricule,$etudiant->getAdresse(),'Matricule','Adresse');
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