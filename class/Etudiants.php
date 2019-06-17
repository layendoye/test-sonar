<?php
namespace AN;
use \PDO;
class Etudiants{
protected $connexion;
    public function __construct($nom_bdd){
        if($this->connexion==null){//si la base de données n est pas deja ouvert on l'ouvre
            $this->connexion=new Bdd($nom_bdd);
        }
    }
    public function findAll(){
        $codesql='SELECT * FROM Etudiants';
        $donnees_des_etudiants = ($this->connexion)->recuperation($codesql);
        return $donnees_des_etudiants;
    }
}