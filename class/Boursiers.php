<?php
namespace AN;
class Boursiers extends Etudiants{
    protected $categorie_Bourse;

    public function __construct($matricule='',$nom='',$prenom='', $naissance='', $email='', $telephone='', $categorie_Bourse=''){
        parent::__construct($matricule,$nom,$prenom, $naissance, $email, $telephone);
        $this->categorie_Bourse=$categorie_Bourse;
    }

    /**
     * Get the value of categorie_Bourse
     */ 
    public function getCategorie_Bourse()
    {
        return $this->categorie_Bourse;
    }

    /**
     * Set the value of categorie_Bourse
     *
     * @return  self
     */ 
    public function setCategorie_Bourse($categorie_Bourse)
    {
        $this->categorie_Bourse = $categorie_Bourse;

        return $this;
    }
}