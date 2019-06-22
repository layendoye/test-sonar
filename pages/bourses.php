<?php require("haut_de_page.php");?>    
<body>
    <?php include('nav.php');?>
    <section class="container sect">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <form action="traitement.php" method="POST"> <?php $form=new Form();?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Libellé','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','nom','form-control col-md-7 espace','Libellé');?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Montant','col-md-2 espace pourLabel')?> 
                         <?php $form->input('number','nom','form-control col-md-7 espace');?>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>                        
                        <?php $form->submit('valider_ajout_bourse','Enregistrer','form-control col-md-5 espace mb');?>
                    </div>
                    
                </form>
            </div>
        </div>
         <!-- Debut tableau -->
        <?php
        $titres=array('Numero','Libellé','Montant','Modification','Supprimer');
        $class=array(
            'col-md-1 text-center',
            'col-md-3 text-center',
            'col-md-3 text-center',
            'col-md-3 text-center',
            'col-md-2 text-center');
        $bourses=EtudiantService::find('Categorie_Bourse');
        $mod=Affichage::bouton_mod_bourse($class,$bourses);
        $sup=Affichage::bouton_sup_bourse($class,$bourses);
        //die(var_dump($sup));
        $form->tableau($titres,$class,$bourses,'col-12 Mes_tableaux table-hover','','row',$mod,$sup);
        ?>
        <!-- Fin tableau -->
    </section>
</body>
<?php require("footer.php");?>