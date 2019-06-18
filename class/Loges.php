<?php
namespace AN;
class Loges extends Etudiants{
    protected $id_Logement;

    public function __construct($matricule='',$id_Logement=''){
        parent::__construct($matricule);
        $this->id_Logement=$id_Logement;
    }
}