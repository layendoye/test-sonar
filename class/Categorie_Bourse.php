<?php
namespace AN;
class Categorie_Bourse extends Loges{
    protected $les_categ_Bourse;
    public function findAllCategorie_Bourse(){
        $codesql='SELECT * FROM Categorie_Bourse';
        $this->les_categ_Bourse = ($this->connexion)->recuperation($codesql);
        return $this->les_categ_Bourse;
    }
    public function findCategorie_Bourse($id_Categ_Bourse){
        $this->findAllCategorie_Bourse();
        for($i=0;$i<count($this->les_categ_Bourse);$i++){
            if($this->les_categ_Bourse[$i]->id_Categ_Bourse==$id_Categ_Bourse){
                return $this->les_categ_Bourse[$i];
            }
        }
    }
}