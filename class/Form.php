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
    public function tableau($titres,$class,$donnees,$class_table="",$class_thead="",$class_tr="",$avantdern_colonne=[],$dern_colonne=[]){
        echo'<table class="'.$class_table.'">
                <thead class="'.$class_thead.'">';
                    echo'<tr class="'.$class_tr.'">';
                            for($i=0;$i<count($titres);$i++){
                                echo '<td class="'.$class[$i].'">'.$titres[$i].'</td>';
                            }
                    echo'</tr>
                </thead>
                <tbody id="developers">';
                        for($i=0;$i<count($donnees);$i++){
                            $a=0;
                            $ligne='';

                            if(isset($_POST["recherche"])) foreach($donnees[$i] as $value){$ligne.=' '.$value;}
                            if(isset($_POST["recherche"]) && $_POST["aRechercher"]!='' && strstr(strtolower($ligne), strtolower($_POST["aRechercher"])) || !isset($_POST["recherche"]) || isset($_POST["recherche"]) && $_POST["aRechercher"]==''){
                                echo'<tr class="'.$class_tr.'">';
                                    foreach($donnees[$i] as $value){
                                        if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                            $value=Affichage::dateFr($value);
                                        echo'<td class="'.$class[$a].'">'.$value.'</td>';
                                        $a++;
                                    }
                                if($avantdern_colonne!='' && $avantdern_colonne!=[])echo $avantdern_colonne[$i];
                                if($dern_colonne!='' && $dern_colonne!=[])echo $dern_colonne[$i];
                                echo'</tr>';
                            }
                        }
                echo'</tbody>
            </table>';
            if($i>7){
            echo'<div class="col-md-12 text-center">
                        <ul class="pagination pagination-sm pager" id="developer_page"></ul>
            </div>';
            }
    }
    
}