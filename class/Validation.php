<?php
class Validation{
    static function securisation($donnees){
        $donnees = trim($donnees); //trim supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $donnees = stripslashes($donnees); //Supprime les antislashs d'une chaîne
        $donnees = strip_tags($donnees); //neutralise le code html et php
        $donnees = addcslashes($donnees, '%_'); //pour gerer les injections sql qui visent notamment à surcharger notre serveur en alourdissant notre requête. Ce type d'injection utilise les caractères % et _.
        return $donnees;
    }
}