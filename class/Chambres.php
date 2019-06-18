<?php
namespace AN;
class Chambres extends Batiment{
    public function findAllChambres(){
        $codesql='SELECT * FROM Chambres';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
}