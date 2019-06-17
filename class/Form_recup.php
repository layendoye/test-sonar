<?php
namespace AN;
/**
 * Class Form_recup
 * permet de générer les anciennes valeur du formulaire
 */
class Form_recup extends Form{
    /**
     * @var array Données utilisées par le formulaire
     */
    protected $data;
    /**
     * @param array $data ,tableau qui récupere les données du tableau
     */
    public function __construct($data=array()){//pour récuperer le tableau de la valeur POST ,initialisé à =array() comme ça c est un paramettre non obligatoire
        $this->data=$data;
    }
    /**
     * @param string $index name de l'input
     * @return string la valeur de l'input
     */
    protected function getValue($index){//l'indice sera le nom exemple $_POST["index"]
        return isset($this->data[$index]) ? $this->data[$index] : null; 
    }
    /**
    * @param string $type type de l'input
    * @param string $name nom de l'input
    * @param string $class class de l'input
    * @return string l'input du formulaire
    */
    public function input($type,$name,$class){
        echo $this->surround('<input type="'.$type.'" class="'.$class.'" name="'.$name.'" value="'.$this->getValue($name).'">');
    }
}