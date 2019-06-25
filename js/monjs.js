///////////////-----------pagination-------------////
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true
    });
});
///////////////-----------Fin pagination-------------////
////////////--------////////
var nom_page = window.location.pathname;
if (nom_page.includes("etudiants.php")) {




    var typeBourse = document.getElementById('typeBourse');
    var batiment = document.getElementById('Batiment');
    var chambre;

    var adresse = document.getElementById('adresse');
    typeBourse.style.display = 'none';
    batiment.style.display = 'none';
    adresse.style.display = 'none';
    if (chambre = document.getElementById('Chambre')) {
        typeBourse.style.display = '';
        batiment.style.display = '';
    };

    function afficherPourBoursier() {
        typeBourse.style.display = '';
        batiment.style.display = 'none';
        adresse.style.display = 'none';
        if (chambre) chambre.style.display = 'none';
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


    var choix;

    if (choix = document.getElementById('Statut Non Boursier')) {
        afficherPourNonBoursier();
    } else if (choix = document.getElementById('Statut Boursier')) {
        afficherPourBoursier();
    } else if (choix = document.getElementById('Statut Loger')) {
        afficherPourLoge();
    }



    var formulaire = document.getElementById('MonForm');

    function envoiFormulaire() {
        formulaire.onsubmit();
    }

}