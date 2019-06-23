///////////////-----------pagination-------------////
$(document).ready(function() {
    $('#developers').pageMe({
        pagerSelector: '#developer_page',
        showPrevNext: true,
        hidePageNumbers: false,
        perPage: 10
    });
});
///////////////-----------Fin pagination-------------////
////////////--------////////
var nom_page = window.location.pathname;
if (nom_page.includes("etudiants.php") || nom_page.includes("modifier.php")) {
    var choix = document.getElementById('Boursier');
    var typeBourse = document.getElementById('typeBourse');
    var chambre = document.getElementById('Chambre');
    var adresse = document.getElementById('adresse');
    if (choix) typeBourse.style.display = 'none';
    if (choix) chambre.style.display = 'none';
    if (choix) adresse.style.display = 'none';

    function afficherPourBoursier() {
        typeBourse.style.display = '';
        chambre.style.display = 'none';
        adresse.style.display = 'none';
    }

    function afficherPourNonBoursier() {
        typeBourse.style.display = 'none';
        chambre.style.display = 'none';
        adresse.style.display = '';

    }

    function afficherPourLoge() {
        typeBourse.style.display = '';
        chambre.style.display = '';
        adresse.style.display = 'none';

    }


}