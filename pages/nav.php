<?php
echo '<nav class="navbar navbar-expand-lg navbar-light row fixed-top" style="background-color: #141517;">

  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item  ';if ($_GET['title'] == "accueil") {echo 'active';}echo '">
        <a class="nav-link" href="">Accueil<span class="sr-only">(current)</span></a>
      </li>';
        echo'<li class="nav-item ';if ($_GET['title'] == "Etudiants") {echo 'active';}echo '">
          <a class="nav-link" href="etudiants.php?title=Etudiants">Gestion des étudiants</a>
        </li>
        <li class="nav-item ';if ($_GET['title'] == "Bourses") {echo 'active';}echo '">
          <a class="nav-link" href="bourses.php?title=Bourses">Gestion des bourses</a>
        </li>
        <li class="nav-item ';if ($_GET['title'] == "Logements") {echo 'active';}echo '">
          <a class="nav-link" href="logements.php?title=Logements">Gestions des logements</a>
        </li>
        <li class="nav-item ';if ($_GET['title'] == "Parametres") {echo 'active';}echo '">
          <a class="nav-link" href="parametres.php?title=Parametres">Paramètres</a>
        </li>';
      echo'<li class="nav-item">
        <a class="nav-link" href="deconnexion.php?title=">Déconnexion</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="POST" action="">
        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search" name="aRechercher"';
        if(isset($_POST["recherche"]) && !empty($_POST[ "aRechercher"])){echo'value="'.$_POST["aRechercher"].'"'; } 
        echo'>
        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" name="recherche">Rechercher</button>';
        if(isset($_POST[ "recherche"]) && !empty($_POST[ "aRechercher"])){echo'<button class="btn btn-success my-2 my-sm-0" type="submit" name="finRecherche">Fin</button>';}
      echo'</form>';

  echo'</div>
</nav>';
?>
