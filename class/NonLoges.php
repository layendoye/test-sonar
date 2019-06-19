<?php
namespace AN;
use \PDO;
class NonLoges extends Etudiants{
    protected $adresse;

    public function __construct($matricule='',$nom='',$prenom='', $naissance='', $email='', $telephone='', $adresse=''){
        parent::__construct($matricule,$nom,$prenom, $naissance, $email, $telephone);
        $this->adresse=$adresse;
    }
}