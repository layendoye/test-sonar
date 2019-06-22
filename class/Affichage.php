<?php
    class Affichage{
        public static function deboger($element){
            echo "<pre>";
            print_r($element);
            echo " </pres>";
        }
        public static function selectChambre($name,$class){
            $tab_optgroup=EtudiantService::find('Batiment','Nom_bat');
            echo '<select name="'.$name.'" class="'.$class.'">';
            for($a=0;$a<count($tab_optgroup);$a++){
                $optgroup=$tab_optgroup[$a]->Nom_bat;
                echo'<optgroup label="'.$optgroup.'">';
                $idBqt=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$optgroup)[0]->id_Batiment;
                $nbCh=$opt=EtudiantService::find('Chambres','Numero_Ch','id_Batiment',$idBqt);
                    for($b=0;$b<count($nbCh);$b++){
                        $tb=EtudiantService::find('Chambres','*','id_Batiment',$idBqt);
                        $opt=$tb[$b]->Numero_Ch;
                        $idCh=$tb[$b]->id_Chambre;
                        echo'<option value="'.$idCh.'">Chambre '.$opt.' (' .$optgroup.')</option>';
                    }
                echo'</optgroup>';
            }
            echo'</select>';
        }
        
    }