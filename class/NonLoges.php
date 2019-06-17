<?php
namespace AN;
use \PDO;
class NonLoges extends Etudiants{
    public function findAllNonLoges(){
        $codesql='SELECT * FROM Non_Loges';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
}