<?php

/**
 * Class Form
 * permet de générer un formulaire 
 */
class Form{
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
     * @var string utiliser pour encader les input 
     */
    protected $balise_encadrement='p';//la variable pour le nom de la balise d'encadrement
    /**
     * @param string $html code html
     * @return string le code html encadré
     */
    public function label($for,$contenu,$class=''){//pour les balises qui encadre nos input
        echo '<label for="'.$for.'"  class="'.$class.'">'.$contenu.'</label>';
    }
    /**
     * @param string $type type de l'input
     * @param string $name nom de l'input
     * @param string $class class de l'input
     * @return string l'input du formulaire
     */
    public function input($type,$name='',$class='',$placeholder='',$value='',$id='',$recup=false,$onclick='',$require=false){
        if($recup==false){
            echo '<input type="'.$type.'" class="'.$class.'" name="'.$name.'"  id="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'" onclick="'.$onclick.'"'; if($require==true){echo'required="'.$require.''; }echo'">';
        }else{
            echo '<input type="'.$type.'" class="'.$class.'" name="'.$name.'" placeholder="'.$placeholder.'" id="'.$id.'" value="'.$this->getValue($name).'"'; if($require==true){echo'require="'.$require.'"'; }echo'>';
        }
    }
    /**
     * @param string $name nom de l'input
     * @param string $class class de l'input
     * @param string $value le nom de l'input
     * @return string l'input du formulaire
     */
    public function submit($name,$value,$class=''){
        echo '<input type="submit" class="'.$class.'" name="'.$name.'" value="'.$value.'" >';
    }
    public function select($tab_option,$name,$class){     
            echo '<select name="'.$name.'" class="'.$class.'">';
            for($a=0;$a<count($tab_option);$a++){
                foreach($tab_option[$a] as $value) {
                    echo'<option value="'.$value.'">'.$value.'</option>';
                }
            }
            echo'</select>';
    }
    
}