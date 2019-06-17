<?php
namespace AN;
/**
 * Class Form
 * permet de générer un formulaire 
 */
class Form{
    /**
     * @var string utiliser pour encader les input 
     */
    protected $balise_encadrement='p';//la variable pour le nom de la balise d'encadrement
    /**
     * @param string $html code html
     * @return string le code html encadré
     */
    protected function surround($html){//pour les balises qui encadre nos input
        return "<{$this->balise_encadrement}>{$html}</{$this->balise_encadrement}>";
    }
    /**
     * @param string $type type de l'input
     * @param string $name nom de l'input
     * @param string $class class de l'input
     * @return string l'input du formulaire
     */
    public function input($type,$name,$class){
        echo $this->surround('<input type="'.$type.'" class="'.$class.'" name="'.$name.'">');
    }
    /**
     * @param string $name nom de l'input
     * @param string $class class de l'input
     * @param string $value le nom de l'input
     * @return string l'input du formulaire
     */
    public function submit($name,$value,$class){
        echo $this->surround('<input type="submit" class="'.$class.'" name="'.$name.' value="'.$value.'" >');
    }
}