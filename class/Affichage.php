<?php
    class Affichage{
        public static function deboger($element){
            echo "<pre>";
            print_r($element);
            echo " </pres>";
        }
        public static function selectChambre2($name,$class,$selectBat='',$selectCh='',$disabled=false){
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
        public static function selectChambre($name,$class,$id_bat='',$selectCh='',$disabled=false){
            $Ch=EtudiantService::find('Chambres','*','id_Batiment',$id_bat);
            echo '<select name="'.$name.'" class="'.$class.'" '; if($disabled==true){echo' disabled '; }echo'>';
                    for($b=0;$b<count($Ch);$b++){
                        $numeroCh=$Ch[$b]->Numero_Ch;
                        $idCh=$Ch[$b]->id_Chambre;
                        if($selectCh==$idCh)
                            echo'<option value="'.$idCh.'" selected>Chambre '.$numeroCh.'</option>';
                        else
                            echo'<option value="'.$idCh.'">Chambre '.$numeroCh.'</option>';
                    }
            echo'</select>';
        }
        public static function selectBat($name,$class,$selectBat='',$disabled=false){
            $tab_bat=EtudiantService::find('Batiment','*');
            echo '<select name="'.$name.'" class="'.$class.'" onchange="this.form.submit();" '; if($disabled==true){echo' disabled '; }echo'>';
            echo'<option value=""></option>';
            for($a=0;$a<count($tab_bat);$a++){
                $bat=$tab_bat[$a]->Nom_bat;
                $id_bat=$tab_bat[$a]->id_Batiment;
                if($selectBat==$id_bat)
                    echo'<option value="'.$id_batid_bat.'" selected>'.$bat.'</option>';
                else
                    echo'<option value="'.$id_bat.'">'.$bat.'</option>';
            }
            echo'</select>';
        }
        public static function statut_etu($matricule){
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
            return $value;
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
        public static function nmbr_et_Bourse($donnees){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                //die(var_dump($donnees));
                $id_categ_bourse=$donnees[$i]->id_Categ_Bourse;
                $tab[]=count(EtudiantService::find('Boursiers','id_Categ_Bourse','id_Categ_Bourse',$id_categ_bourse));
            }
            return $tab;
        }

        public function tableau_chambre($titres,$donnees,$class_table="",$avantdern_colonne=[],$dern_colonne=[]){
            echo'<table class="'.$class_table.'" id="example" style="width:100%">
                    <thead class="">';
                        echo'<tr class="">';
                                for($i=0;$i<count($titres);$i++){
                                    echo '<td class="">'.$titres[$i].'</td>';
                                }
                        echo'</tr>
                    </thead>
                    <tbody id="developers">';
                            for($i=0;$i<count($donnees);$i++){
                                $a=0;
                                echo'<tr class="">';
                                    foreach($donnees[$i] as $key => $value){
                                        if($key!='id_Chambre'){
                                            if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                                $value=Validation::dateFr($value);
                                                if($key =='id_Batiment' && EtudiantService::find('Batiment','Nom_bat','id_Batiment',$value)!=null)
                                                    echo'<td class="">'.EtudiantService::find('Batiment','Nom_bat','id_Batiment',$value)[0]->Nom_bat.'</td>';
                                                else
                                                    echo'<td class="">'.$value.'</td>';
                                            $a++;
                                        }
                                    }
                                echo '<td class="">'.self::nmbr_et_ch($donnees[$i]->id_Chambre).'</td>';
                                if($avantdern_colonne!='' && $avantdern_colonne!=[])echo '<td>'.$avantdern_colonne[$i].'</td>';
                                if($dern_colonne!='' && $dern_colonne!=[])echo '<td>'.$dern_colonne[$i].'</td>';
                                echo'</tr>';
                            
                            }
                    echo'</tbody>
                </table>';
        }
        public function tableau_bat($titres,$donnees,$class_table="",$avantdern_colonne=[],$dern_colonne=[]){
            echo'<table class="'.$class_table.'" id="example" style="width:100%">
                <thead class="">';
                    echo'<tr class="">';
                            for($i=0;$i<count($titres);$i++){
                                echo '<td class="">'.$titres[$i].'</td>';
                            }
                    echo'</tr>
                </thead>
                <tbody id="developers">';
                        for($i=0;$i<count($donnees);$i++){
                            $a=0;
                            $ligne='';
                            
                            echo'<tr class="">';
                                foreach($donnees[$i] as $key => $value){
                                    if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                        $value=Validation::dateFr($value);
                                            if($key!='id_Batiment')
                                                echo'<td class="">'.$value.'</td>';
                                            else
                                                echo'<td class="">'.($i+1).'</td>';
                                    $a++;
                                }
                            echo '<td class="">'.count(EtudiantService::find('Chambres','id_Chambre','id_Batiment',$donnees[$i]->id_Batiment)).'</td>';
                            echo '<td class="">'.self::nmbr_et_Bat($donnees[$i]->id_Batiment).'</td>';
                            if($avantdern_colonne!='' && $avantdern_colonne!=[])echo '<td>'.$avantdern_colonne[$i].'</td>';
                            if($dern_colonne!='' && $dern_colonne!=[])echo '<td>'.$dern_colonne[$i].'</td>';
                            echo'</tr>';
                        }
                echo'</tbody>
            </table>';
        }
        public function tableau_etu($titres,$donnees,$class_table=""){
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
                        echo'<tr class="">';
                            foreach($donnees[$i] as $key => $value){
                                if(Validation::verifierDate($value, $format = 'Y-m-d'))
                                    $value=Validation::dateFr($value);
                                if($key=='Matricule')
                                    $value='SA-'.$value;
                                echo'<td class="">'.$value.'</td>';
                            }
                            $statut=self::statut_etu($donnees[$i]->Matricule);
                            echo'<td class="">'.$statut.'</td>';
                            echo'<td class="boutonAll"><a class="nonSoulign" href="etudiants.php?title=Etudiants&matricule_modif='.$donnees[$i]->Matricule.'&Statut_et='.$statut.'" ><button class="btn btn-outline-primary">Modifier</button></a></td>';
                            echo'<td class="boutonAll"><a class="nonSoulign" href="etudiants.php?title=Etudiants&matricule_sup='.$donnees[$i]->Matricule.'" ><button class="btn btn-outline-danger">Supprimer</button></a></td>';    
                        echo'</tr>';
                    }
                echo'</tbody>
            </table>';
        }
        public static function bouton($donnees,$pages,$title='',$trite_Get,$class_but='',$nom_But){
            $tab=[];
            for($i=0;$i<count($donnees);$i++){
                foreach($donnees[$i] as $value)
                    $tab[]='<a class="nonSoulign" href="'.$pages.'?title='.$title.'&'.$trite_Get.'='.$value.'" ><button class="'.$class_but.'">'.$nom_But.'</button></a>';
            }
            return $tab;
        }
    }