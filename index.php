<?php
    require("pages/haut_de_page.php");
    $_SESSION['page']='index';
?>    
<body>
   <h1 class="clo-md-10">Testes en POO</h1>
   <section class="container-fluid sect">
        <button class="bt bt-primary"><a href="pages/etudiants.php?title=Etudiants">Etudiants</a></button>
    </section>
</body>
<?php
    require("pages/footer.php");
?>