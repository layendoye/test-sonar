<?php
namespace AN;
class Boursiers extends Etudiants{
    protected $categorie_Bourse;

    public function __construct($matricule='',$categorie_Bourse=''){
        parent::__construct($matricule);
        $this->categorie_Bourse=$categorie_Bourse;
    }
}