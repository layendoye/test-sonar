<?php
namespace AN;
class Loges extends Boursiers{
    protected $id_Logement;

    public function __construct($matricule='',$nom='',$prenom='', $naissance='', $email='', $telephone='',$categorie_Bourse='',$id_Logement=''){
        parent::__construct($matricule,$nom,$prenom, $naissance, $email, $telephone, $categorie_Bourse);
        $this->id_Logement=$id_Logement;
    }
}