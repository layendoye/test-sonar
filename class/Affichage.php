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
        public static function bouton_inf_etu($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $matricule=$donnees[$i]->Matricule;
                $tab[]='<td class="'.$class[count($class)-2].' boutonAll"><a class="nonSoulign" href="modifier.php?title=Modification&matricule_info='.$matricule.'" ><button class="btn btn-outline-primary btinf">Info</button></a></td>';
            }
            return $tab;
        }
        public static function bouton_sup_etu($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $matricule=$donnees[$i]->Matricule;
                $tab[]='<td class="'.$class[count($class)-1].' boutonAll"><a class="nonSoulign" href="etudiants.php?title=Etudiants&matricule_sup='.$matricule.'" ><button class="btn btn-outline-danger btsupet">Supprimer</button></a></td>';
            }
            return $tab;
        }
        public static function bouton_mod_bourse($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_Categ_Bourse=$donnees[$i]->id_Categ_Bourse;
                $tab[]='<td class="'.$class[count($class)-2].' boutonAll"><a class="nonSoulign" href="bourses.php?title=Bourses&id_Categ_Bourse_mod='.$id_Categ_Bourse.'" ><button class="btn btn-outline-primary btinf">Modifier</button></a></td>';
            }
            return $tab;
        }
        public static function bouton_sup_bourse($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_Categ_Bourse=$donnees[$i]->id_Categ_Bourse;
                $tab[]='<td class="'.$class[count($class)-1].' boutonAll"><a class="nonSoulign" href="bourses.php?title=Bourses&id_Categ_Bourse_sup='.$id_Categ_Bourse.'" ><button class="btn btn-outline-danger btinf">Supprimer</button></a></td>';
            }
            return $tab;
        }
        public static function bouton_mod_chambres($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_Chambre=$donnees[$i]->id_Chambre;
                $tab[]='<td class="'.$class[count($class)-2].' boutonAll"><a class="nonSoulign" href="chambres.php?title=Chambres&id_Chambre_mod='.$id_Chambre.'" ><button class="btn btn-outline-primary btinf">Modifier</button></a></td>';
            }
            return $tab;
        }
        public static function bouton_sup_chambres($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_Chambre=$donnees[$i]->id_Chambre;
                $tab[]='<td class="'.$class[count($class)-1].' boutonAll"><a class="nonSoulign" href="chambres.php?title=Chambres&id_Chambre_sup='.$id_Chambre.'" ><button class="btn btn-outline-danger btinf">Supprimer</button></a></td>';
            }
            return $tab;
        }
        public static function nmbr_et_ch($id_ch){
            $tab=EtudiantService::find('Loges','id_Chambre','id_Chambre',$id_ch);
            return count($tab);
        }
        public static function nmbr_et_Bat($id_bat){
            $etu=0;
            $ch=EtudiantService::find('Chambres','id_Chambre','id_Batiment',$id_bat);
            for($i=0;$i<count($ch);$i++){
                $id_ch=$ch[$i]->id_Chambre;
                $etu+=self::nmbr_et_ch($id_ch);
            }
            return $etu;
        }
        public function tableau_chambre($titres,$class,$donnees,$class_table="",$class_thead="",$class_tr="",$avantdern_colonne=[],$dern_colonne=[]){
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
                                echo'<tr class="'.$class_tr.'">';
                                    foreach($donnees[$i] as $key => $value){
                                        if($key!='id_Chambre'){
                                            if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                                $value=Affichage::dateFr($value);
                                                if($key =='id_Batiment' && EtudiantService::find('Batiment','Nom_bat','id_Batiment',$value)!=null)
                                                    echo'<td class="'.$class[$a].'">'.EtudiantService::find('Batiment','Nom_bat','id_Batiment',$value)[0]->Nom_bat.'</td>';
                                                else
                                                    echo'<td class="'.$class[$a].'">'.$value.'</td>';
                                            $a++;
                                        }
                                    }
                                echo '<td class="'.$class[count($class)-3].'">'.self::nmbr_et_ch($donnees[$i]->id_Chambre).'</td>';
                                if($avantdern_colonne!='' && $avantdern_colonne!=[])echo $avantdern_colonne[$i];
                                if($dern_colonne!='' && $dern_colonne!=[])echo $dern_colonne[$i];
                                echo'</tr>';
                            }
                    echo'</tbody>
                </table>';
                if($i>7){
                    echo'<div class="col-md-12 text-center">
                                <ul class="pagination pagination-sm pager" id="developer_page"></ul>
                    </div>';
                }
        }
        public function tableau_bat($titres,$class,$donnees,$class_table="",$class_thead="",$class_tr="",$avantdern_colonne=[],$dern_colonne=[]){
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
                            echo'<tr class="'.$class_tr.'">';
                                foreach($donnees[$i] as $key => $value){
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Affichage::dateFr($value);
                                            if($key!='id_Batiment')
                                                echo'<td class="'.$class[$a].'">'.$value.'</td>';
                                            else
                                                echo'<td class="'.$class[$a].'">'.($i+1).'</td>';
                                    $a++;
                                }
                            echo '<td class="'.$class[count($class)-3].'">'.count(EtudiantService::find('Chambres','id_Chambre','id_Batiment',$donnees[$i]->id_Batiment)).'</td>';
                            echo '<td class="'.$class[count($class)-4].'">'.self::nmbr_et_Bat($donnees[$i]->id_Batiment).'</td>';
                            if($avantdern_colonne!='' && $avantdern_colonne!=[])echo $avantdern_colonne[$i];
                            if($dern_colonne!='' && $dern_colonne!=[])echo $dern_colonne[$i];
                            echo'</tr>';
                        }
                echo'</tbody>
            </table>';
            if($i>7){
                echo'<div class="col-md-12 text-center">
                            <ul class="pagination pagination-sm pager" id="developer_page"></ul>
                </div>';
            }
        }
        public static function bouton_mod_bat($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_Batiment=$donnees[$i]->id_Batiment;
                $tab[]='<td class="'.$class[count($class)-2].' boutonAll"><a class="nonSoulign" href="batiments.php?title=Batiments&id_Batiment_mod='.$id_Batiment.'" ><button class="btn btn-outline-primary btinf">Modifier</button></a></td>';
            }
            return $tab;
        }
        public static function bouton_sup_bat($class,$donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                $id_Batiment=$donnees[$i]->id_Batiment;
                $tab[]='<td class="'.$class[count($class)-1].' boutonAll"><a class="nonSoulign" href="batiments.php?title=Batiments&id_Batiment_sup='.$id_Batiment.'" ><button class="btn btn-outline-danger btinf">Supprimer</button></a></td>';
            }
            return $tab;
        }
    }