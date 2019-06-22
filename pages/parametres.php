<?php require("haut_de_page.php");?>    
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <form action="traitement.php" method="POST"> <?php $form=new Form();?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Nom','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','nom','form-control col-md-7 espace');?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                       <?php $form->label('','Prénom','col-md-2 espace pourLabel')?> 
                        <?php $form->input('text','prenom','form-control col-md-7 espace');?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Naissance','col-md-2 espace pourLabel')?> 
                        <?php $form->input('date','naiss','form-control col-md-7 espace');?>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>                        
                        <?php $form->submit('valider','Envoyer','form-control col-md-5 espace mb');?>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<?php require("footer.php");?>