<?php
namespace AN;
use \PDO;
class Logement extends Chambres{
    public function findAllLogement(){
        $codesql='SELECT * FROM Logement';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
}