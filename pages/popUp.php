<?php if(isset($_GET['popUp'])){?>
    <?php $etu=EtudiantService::info($_GET['popUp'])?>
    <div class="popUp" >
        <div class="ligne">
            <p class="left">Matricule </p><strong>:</strong>
            <p class='right'><?php echo "SA-".$_GET['popUp']?></p>
        </div>

        <div class="ligne">
            <p class="left">Nom </p><strong>:</strong>
            <p class='right'><?php echo $etu['Nom']?></p>
        </div>

        <div class="ligne">
            <p class="left">Prénom </p><strong>:</strong>
            <p class='right'><?php echo $etu['Prenom']?></p>
        </div>

        <div class="ligne">
            <p class="left">Naissance </p><strong>:</strong>
            <p class='right'><?php echo Validation::dateFr($etu['Naissance']);?></p>
        </div>

        <div class="ligne">
            <p class="left">Email </p><strong>:</strong>
            <p class='right'><?php echo $etu['Email']?></p>
        </div>

        <div class="ligne">
            <p class="left">Téléphone </p><strong>:</strong>
            <p class='right'><?php echo $etu['Telephone']?></p>
        </div>

        <?php if(isset($etu['Libelle'])){?>
        <div class="ligne">
            <p class="left">Bourse </p><strong>:</strong>
            <p class='right'><?php echo $etu['Libelle'].' ('.Validation::millier($etu['Montant']).')'?></p>
        </div>
        <?php }?>

        <?php if(isset($etu['Nom_bat'])){?>
        <div class="ligne">
            <p class="left">Batiment</p><strong>:</strong>
            <p class='right'><?php echo $etu['Nom_bat']?></p>
        </div>
        <?php }?>

        <?php if(isset($etu['Numero_Ch'])){?>
        <div class="ligne">
            <p class="left">Chambre</p><strong>:</strong>
            <p class='right'><?php echo 'Chambre '.$etu['Numero_Ch']?></p>
        </div>
        <?php }?>

        <div class="ligne bout">
            <p class="left"><a href="etudiants.php?title=Etudiants"><button class="form-control btn btn-outline-primary">Valider</button></a></p>
            <p class='left'><a <?php echo 'href="etudiants.php?title=Etudiants&matricule_modif='.$_GET['popUp'].'"';?>><button class="form-control btn btn-outline-primary">Modifier</button></a></p>
        </div>
    </div>
<?php }?>