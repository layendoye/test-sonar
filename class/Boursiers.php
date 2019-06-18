<?php
namespace AN;
class Boursiers extends Categorie_Bourse{
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
     
}