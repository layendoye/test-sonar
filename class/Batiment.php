<?php
namespace AN;
class Batiment extends Etudiants{
    public function findAllBatiment(){
        $codesql='SELECT * FROM Batiment';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
}