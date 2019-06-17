<?php
    require("pages/haut_de_page.php");
    $_SESSION['page']='index';
?>    
<body>
   <h1 class="clo-md-10">Testes en POO</h1>
   <button class="bt bt-primary"><a href="pages/produits.php?title=Produits">Produits</a></button>
</body>
<?php
    require("pages/footer.php");
?>