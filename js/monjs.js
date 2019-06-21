///////////////-----------pagination-------------////
$(document).ready(function() {
    $('#developers').pageMe({
        pagerSelector: '#developer_page',
        showPrevNext: true,
        hidePageNumbers: false,
        perPage: 7
    });
});
///////////////-----------Fin pagination-------------////
////////////----pour graphique accueil----////////
var nom_page = window.location.pathname;
if (nom_page.includes("etudiants.php")) {
    var choix1 = document.getElementById('nonBoursier');
    var choix2 = document.getElementById('Boursier');
    var choix3 = document.getElementById('Loger');

    var typeBourse = document.getElementById('typeBourse');
    var chambre = document.getElementById('Chambre');
    var adresse = document.getElementById('adresse');
    typeBourse.style.display = 'none';
    chambre.style.display = 'none';
    adresse.style.display = 'none';

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