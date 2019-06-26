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
    public function input($type,$name='',$class='',$placeholder='',$value='',$id='',$recup=false,$onclick='',$require=false,$readOnly=false){
        if($recup==false){
            echo '<input type="'.$type.'" class="'.$class.'" name="'.$name.'"  id="'.$id.'" value="'.$value.'" placeholder="'.$placeholder.'" onclick="'.$onclick.'"'; if($require==true){echo'required="'.$require.'" '; } if($readOnly==true){echo' readonly '; }echo'>';
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
    public function select($tab_option,$name,$class,$select='',$disabled=false){
            echo '<select name="'.$name.'" class="'.$class.'"'; if($disabled==true){echo' disabled '; }echo'>';
            for($a=0;$a<count($tab_option);$a++){
                foreach($tab_option[$a] as $value) {
                    if($select!=$value)
                        echo'<option value="'.$value.'">'.$value.'</option>';
                    else
                        echo'<option value="'.$value.'" selected>'.$value.'</option>';
                }
            }
            echo'</select>';
    }
    public function tableau($titres,$donnees,$class_table="",$autres1=[],$autres2=[],$autres3=[],$autres4=[],$autres5=[],$autres6=[],$autres7=[],$autres8=[],$autres9=[],$autres10=[]){
        echo'<table class="'.$class_table.'" id="example" style="width:100%">
                <thead class="">';
                    echo'<tr class="">';
                            for($i=0;$i<count($titres);$i++){
                                echo '<td class="">'.$titres[$i].'</td>';
                            }
                    echo'</tr>
                </thead>
                <tbody>';
                    for($i=0;$i<count($donnees);$i++){
                        //die(var_dump($donnees));
                        echo'<tr class="">';
                            foreach($donnees[$i] as $value){
                                if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                    $value=Validation::dateFr($value);
                                echo'<td class="">'.$value.'</td>';
                            }
                            if($autres1!=[] && $autres1!=''){
                                $value=$autres1[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres2!=[] && $autres2!=''){
                                $value=$autres2[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres3!=[] && $autres3!=''){
                                $value=$autres3[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres4!=[] && $autres4!=''){
                                $value=$autres4[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres5!=[] && $autres5!=''){
                                $value=$autres5[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres6!=[] && $autres6!=''){
                                $value=$autres6[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres7!=[] && $autres7!=''){
                                $value=$autres7[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres8!=[] && $autres8!=''){
                                $value=$autres8[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres9!=[] && $autres9!=''){
                                $value=$autres9[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                            if($autres10!=[] && $autres10!=''){
                                $value=$autres10[$i];
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                    echo'<td class="">'.$value.'</td>';
                            }
                        echo'</tr>';
                    }
            echo'</tbody>
        </table>';
    }
}