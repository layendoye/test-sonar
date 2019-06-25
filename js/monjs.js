///////////////-----------pagination-------------////
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true
    });
});
///////////////-----------Fin pagination-------------////
////////////--------////////
var nom_page = window.location.pathname;
if (nom_page.includes("etudiants.php") || nom_page.includes("modifier.php")) {
    var choix = document.getElementById('Boursier');
    var typeBourse = document.getElementById('typeBourse');
    var batiment = document.getElementById('Batiment');
    var chambre;

    var adresse = document.getElementById('adresse');
    if (choix) typeBourse.style.display = 'none';
    if (choix) batiment.style.display = 'none';
    if (choix) adresse.style.display = 'none';
    if (chambre = document.getElementById('Chambre')) {
        typeBourse.style.display = '';
        batiment.style.display = '';
    };

    function afficherPourBoursier() {
        typeBourse.style.display = '';
        batiment.style.display = 'none';
        adresse.style.display = 'none';
        chambre.style.display = 'none';
    }

    function afficherPourNonBoursier() {
        typeBourse.style.display = 'none';
        batiment.style.display = 'none';
        if (chambre) chambre.style.display = 'none';
        adresse.style.display = '';

    }

    function afficherPourLoge() {
        typeBourse.style.display = '';
        batiment.style.display = '';
        if (chambre) chambre.style.display = '';
        adresse.style.display = 'none';

    }
    var formulaire = document.getElementById('MonForm');

    function envoiFormulaire() {
        formulaire.onsubmit();
    }

}