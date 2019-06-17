<?php
namespace AN;
use \PDO;
class Loges extends Logement{
    public function findAllLoges(){
        $codesql='SELECT * FROM Loges';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
}