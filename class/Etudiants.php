<?php
namespace AN;
abstract class Etudiants{
    protected $matricule;
    protected $nom;
    protected $prenom;
    protected $naissance;
    protected $email;
    protected $telephone;
    protected $id_Statut;

    public function __construct($matricule='',$nom='',$prenom='', $naissance='', $email='', $telephone='', $id_Statut=''){
        $this->matricule=$matricule;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->naissance=$naissance;
        $this->email=$email;
        $this->telephone=$telephone;
        $this->id_Statut=$id_Statut;
    }
}