<?php
    namespace AN;
    use \PDO; //car PDO n'est pas dans le namespace AN c est une classe de php
    class Bdd{
        private $nom_bdd;
        private $serveur;
        private $Monlogin;
        private $Monpass;
        private $connexion;

        public function __construct($nom_bdd,$serveur = "localhost",$Monlogin = "root",$Monpass = "101419"){//comme ca les 3 autres elements seront facultatives
            $this->$nom_bdd=$nom_bdd;
            $this->$serveur=$serveur;
            $this->$Monlogin=$Monlogin;
            $this->$Monpass=$Monpass;
        }
        
        private function getPDO(){
            if($this->$connexion==null){//pour ne pas se connecter a la base de donnee encore et encore
                $serveur=$this->$serveur;
                $nom_bdd=$this->$nom_bdd;
                $connexion = new PDO("mysql:host=$serveur;dbname=$nom_bdd;charset=utf8", $this->$Monlogin, $this->$Monpass); //se connecte au serveur mysquel
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //setAttribute — Configure l'attribut PDO $connexion
                $this->$connexion=$connexion;
            }
            
            return $this->$connexion;
        }
        
        public function recuperation($le_codemysql){
            $requete = $this->getPDO->prepare($le_codemysql); //Prépare la requête $codemysql à l'exécution
            $requete->execute();
            $donnee=$requete->fetchAll();
            return $donnee;
        }

        public function securisation($donnees){
                    $donnees = trim($donnees); //trim supprime les espaces (ou d'autres caractères) en début et fin de chaîne
                    $donnees = stripslashes($donnees); //Supprime les antislashs d'une chaîne
                    $donnees = strip_tags($donnees); //neutralise le code html et php
                    $donnees = addcslashes($donnees, '%_'); //pour gerer les injections sql qui visent notamment à surcharger notre serveur en alourdissant notre requête. Ce type d'injection utilise les caractères % et _.
                    return $donnees;
        }
    }
    