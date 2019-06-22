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
    private static function updateTable($table,$valeur1,$valeur2,$Nomcol_valeur1,$Nomcol_valeur2){
        $valeur1=Validation::securisation($valeur1);
        $valeur2=Validation::securisation($valeur2);
        if($table=='Boursiers') //on recupere l'id
            $valeur2=self::findId_Categorie_Bourse($valeur2);
        
        $codemysql = "UPDATE `$table`  SET $Nomcol_valeur2='$valeur2', $Nomcol_valeur1='$valeur1'"; //le code mysql
        $requete = (Bdd::getPDO())->prepare($codemysql);//on recupere le PDO 
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
    public static function update(Etudiants $etudiant){
        $donnee_etudiants=self::find('Etudiants');

        $matricule=Validation::securisation($etudiant->getMatricule());
        $nom=Validation::securisation($etudiant->getNom());
        $prenom=Validation::securisation($etudiant->getPrenom());
        $naissance=Validation::securisation($etudiant->getNaissance());
        $telephone=Validation::securisation($etudiant->getTelephone());
        $email=Validation::securisation($etudiant->getEmail());
        $codemysql = "UPDATE `Etudiants` SET Nom='$nom', Prenom='$prenom', Naissance='$naissance', Email='$email', Telephone='$telephone' WHERE Matricule='$matricule' "; //le code mysql
        $requete = (Bdd::getPDO())->prepare($codemysql);//on recupere le PDO 
        $requete->execute(); //excecute la requete qui a été preparé

        if(get_class($etudiant)=='Boursiers'){
            if(self::find('Non_Boursiers','*','Matricule',$matricule)!=null) self::delete('Non_Boursiers','Matricule',$matricule);//il etait avant un non boursier donc on le supprime de la table non boursier
            if(self::find('Loges','*','Matricule',$matricule)!=null) self::delete('Loges','Matricule',$matricule);//meme chose

            if(self::find('Boursiers','*','Matricule',$matricule)!=null) 
                self::updateTable('Boursiers',$matricule,$etudiant->getLibelle_categ_Bourse(),'Matricule','id_Categ_Bourse');//si exister on le modifie
            else
                self::addTable('Boursiers',$matricule,$etudiant->getLibelle_categ_Bourse(),'Matricule','id_Categ_Bourse');//sinon on le cree
        }
        elseif(get_class($etudiant)=='Loges'){
            if(self::find('Non_Boursiers','*','Matricule',$matricule)!=null) self::delete('Non_Boursiers','Matricule',$matricule);

            if(self::find('Boursiers','*','Matricule',$matricule)!=null) 
                self::updateTable('Boursiers',$matricule,$etudiant->getLibelle_categ_Bourse(),'Matricule','id_Categ_Bourse');
            else
                self::addTable('Boursiers',$matricule,$etudiant->getLibelle_categ_Bourse(),'Matricule','id_Categ_Bourse');

            if(self::find('Loges','*','Matricule',$matricule)!=null) 
                self::updateTable('Loges',$matricule,$etudiant->getId_Chambre(),'Matricule','id_Chambre');
            else
                self::addTable('Loges',$matricule,$etudiant->getId_Chambre(),'Matricule','id_Chambre');
            
        }
        elseif(get_class($etudiant)=='Non_Boursiers'){
            if(self::find('Loges','*','Matricule',$matricule)!=null) self::delete('Loges','Matricule',$matricule);
            if(self::find('Boursiers','*','Matricule',$matricule)!=null) self::delete('Boursiers','Matricule',$matricule);
            

            self::updateTable('Non_Boursiers',$matricule,$etudiant->getAdresse(),'Matricule','Adresse');
        }
    }
    public static function delete($table,$colonne='0',$valeur='0'){
        $codesql="DELETE FROM $table WHERE $colonne='$valeur'";
        $requete = (Bdd::getPDO())->prepare($codesql);
        $requete->execute();
    }
    public static function find($table,$element='*',$colonne='0',$valeur='0'){//0=0 renvoi true donc si on ne rempli pas les champ il va tout afficher
        $codesql="SELECT $element FROM $table WHERE $colonne='$valeur'";
        $donnees_des_etudiants = Bdd::recuperation($codesql);
        return $donnees_des_etudiants;
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
        if(self::find('Boursiers','*','Matricule',$matricule)!=null)
            $boursier=true;
        if(self::find('Loges','*','Matricule',$matricule)!=null)
            $loge=true;        

        return array('Boursier'=>$boursier,'Loge'=>$loge);
    }
    public static function info($matricule){
        $donnees=array();
        if($matricule!=null){
            $donnees['Statut']=self::checkStatut($matricule);
            $etudiants=self::find('Etudiants','*','Matricule',$matricule);
            if($etudiants!=null){
                $donnees['Nom']=$etudiants[0]->Nom;
                $donnees['Prenom']=$etudiants[0]->Prenom;
                $donnees['Naissance']=$etudiants[0]->Naissance;
                $donnees['Email']=$etudiants[0]->Email;
                $donnees['Telephone']=$etudiants[0]->Telephone;
            }
        //die(var_dump($etudiants));
            $etudiants=self::find('Loges','*','Matricule',$matricule);
            if($etudiants!=null){
                $donnees['id_Loge']=$etudiants[0]->id_Loge;
                $donnees['id_Chambre']=$etudiants[0]->id_Chambre;
            }
            
            $etudiants=self::find('Boursiers','*','Matricule',$matricule);
            if($etudiants!=null){
                $donnees['id_Boursier']=$etudiants[0]->id_Boursier;
                $donnees['id_Categ_Bourse']=$etudiants[0]->id_Categ_Bourse;
            }

            $etudiants=self::find('Non_Boursiers','*','Matricule',$matricule);
            if($etudiants!=null){
                $donnees['id_Non_Boursiers']=$etudiants[0]->id_Non_Boursiers;
                $donnees['Adresse']=$etudiants[0]->Adresse;
            }
        }

        if(isset($donnees['id_Chambre'])){
            $etudiants=self::find('Chambres','*','id_Chambre',$donnees['id_Chambre']);
            if($etudiants!=null){
            $donnees['Numero_Ch']=$etudiants[0]->Numero_Ch;
            $donnees['id_Batiment']=$etudiants[0]->id_Batiment;
            }
        }

        if(isset($donnees['id_Batiment'])){
            $etudiants=self::find('Batiment','Nom_bat','id_Batiment',$donnees['id_Batiment']);
            if($etudiants!=null){
                $donnees['Nom_bat']=$etudiants[0]->Nom_bat;
            }
        }

            

        if(isset($donnees['id_Categ_Bourse'])){
        $etudiants=self::find('Categorie_Bourse','*','id_Categ_Bourse',$donnees['id_Categ_Bourse'])[0];
            if($etudiants!=null){
                $donnees['Libelle']=$etudiants->Libelle;
                $donnees['Montant']=$etudiants->Montant;
            }
        }
        return $donnees;
    }
}