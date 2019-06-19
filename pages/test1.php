<!DOCTYPE html>
<html lang="FR-fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Teste POO</title>
</head>
<body>
    <?php
        include("connexionBDD.php");
        $form=new Form();//le  est le nom du namespace ou se trouve la classe
        $Form_recup=new Form_recup($_POST);
    ?>
    <form action="" method="POST">
    <?php
        $form->input('text','username','form-control');
        $Form_recup->input('text','username','form-control');
        $form->input('password','password','form-control');
        $form->submit('valider','Envoyer','form-control');
        print_r(Nombre::formatDz(5));//pout les methode static
        Presentation::afficher($form);
        Presentation::afficher($Form_recup);
    ?>
    </form>
</body>
</html>