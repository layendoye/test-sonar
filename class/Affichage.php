<?php
    class Affichage{
        public static function deboger($element){
            echo "<pre>";
            print_r($element);
            echo " </pres>";
        }
        public static function dateFr($date_En){
            $datN = new DateTime($date_En);
            $date_Fr = $datN->format('d-m-Y');
            return $date_Fr ;
        }
        public static function selectChambre($name,$class,$selectBat='',$selectCh='',$disabled=false){
            $tab_optgroup=EtudiantService::find('Batiment','Nom_bat');
            echo '<select name="'.$name.'" class="'.$class.'" '; if($disabled==true){echo' disabled '; }echo'>';
            for($a=0;$a<count($tab_optgroup);$a++){
                $optgroup=$tab_optgroup[$a]->Nom_bat;
                echo'<optgroup label="'.$optgroup.'">';
                $idBqt=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$optgroup)[0]->id_Batiment;
                $nbCh=$opt=EtudiantService::find('Chambres','Numero_Ch','id_Batiment',$idBqt);
                    for($b=0;$b<count($nbCh);$b++){
                        $tb=EtudiantService::find('Chambres','*','id_Batiment',$idBqt);
                        $opt=$tb[$b]->Numero_Ch;
                        $idCh=$tb[$b]->id_Chambre;
                        if($selectBat==$optgroup && $selectCh==$opt)
                            echo'<option value="'.$idCh.'" selected>Chambre '.$opt.' (' .$optgroup.')</option>';
                        else
                            echo'<option value="'.$idCh.'">Chambre '.$opt.' (' .$optgroup.')</option>';
                    }
                echo'</optgroup>';
            }
            echo'</select>';
        }
        public static function statut_etu($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $matricule=$donnees[$i]->Matricule;
                $statut=EtudiantService::checkStatut($matricule);
                if($statut['Boursier']==true && $statut['Loge']==true){
                    $value='Loger';
                }
                elseif($statut['Boursier']==true && $statut['Loge']==false){
                    $value='Boursier';
                }
                elseif($statut['Boursier']==false && $statut['Loge']==false){
                    $value='Non Boursier';
                }
                $tab[]='<td class="'.$class[count($class)-1].'">'.$value.'</td>';
            }
            return $tab;
        }
        public static function bouton_info($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $matricule=$donnees[$i]->Matricule;
                $tab[]='<td class="'.$class[count($class)-1].'"><a class="nonSoulign" href="modifier.php?title=Etudiants&matricule_info='.$matricule.'" ><button class="btn btn-outline-primary btinf">Info</button></a></td>';
            }
            return $tab;
        }
        
    }