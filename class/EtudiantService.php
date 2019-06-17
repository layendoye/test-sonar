<?php
namespace AN;
class EtudiantService{
    public $matricule;
    public $nom;
    public $prenom;
    public $Naissance;
    public $email;
    public $telephone;
    public $id_Statut;
    public $les_etudiants;
    public function les_etudiants(){
        $bdd=new Bdd('Universite');
        $codesql='SELECT * FROM Etudiants';
        $les_etudiants = $bdd->recuperation($codesql);
        return $les_etudiants;
        
    }


}