<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>  
<body>
    <?php include('nav.php');?>
    <section class="container sect">
        <div class="row">
            <div class="col-3"></div>
            <h1 class="textAc col-6">Répartition étudiants</h1>
        </div>
        <div class='row diagCircl'>
            <div class='col-1'></div>
            <div class='col-4'>
                <?php $non_bour=(count(EtudiantService::find('Non_Boursiers'))*100)/count(EtudiantService::find('Etudiants'));?>
                <div <?php echo 'class="c100 p'.intval($non_bour).' big"'; ?>>
                    <span><?php echo intval($non_bour).'%';?></span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
            <div class='col-4'>
                <?php $bour=(count(EtudiantService::find('Boursiers'))*100)/count(EtudiantService::find('Etudiants'));?>
                <div <?php echo 'class="c100 p'.intval($bour).' big"'; ?>>
                    <span><?php echo intval($bour).'%';?></span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
            <div class='col-3'>
                <?php $loger=(count(EtudiantService::find('Loges'))*100)/count(EtudiantService::find('Etudiants'));?>
                <div <?php echo 'class="c100 p'.intval($loger).' big"'; ?>>  
                    <span><?php echo intval($loger).'%';?></span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class='row '>
            
            <div class='col-4'>
                <p class="titreCircle t1">Non boursiers</p>
            </div>
            <div class='col-4'>
                <p class="titreCircle t2">Boursiers</p>
            </div>
            <div class='col-3'>
                <p class="titreCircle titreCirLog t3">Logers</p>
            </div>
        </div>

    </section>
</body>
<?php require("footer.php");?>