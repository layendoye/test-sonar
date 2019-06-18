<?php
namespace AN;
use \PDO;
class NonLoges extends Etudiants{
    protected $adresse;

    public function __construct($matricule='',$adresse=''){
        parent::__construct($matricule);
        $this->adresse=$adresse;
    }
}