<?php
namespace AN;
use \PDO;
class Boursiers extends Categorie_Bourse{
    public function findAllBoursiers(){
        $codesql='SELECT * FROM Boursiers';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
}