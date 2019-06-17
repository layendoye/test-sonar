<?php
namespace AN;
use \PDO;
class Categorie_Bourse extends Loges{
    public function findAllCategorie_Bourse(){
        $codesql='SELECT * FROM Categorie_Bourse';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
}