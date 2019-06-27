///////////////-----------Début DataTable-------------////
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true
    });
});
///////////////-----------Fin DataTable-------------////

////////////----Début Page étudidant----////////
var nom_page = window.location.pathname;
if (nom_page.includes("etudiants.php")) {
    var nom = document.getElementById('Nom');
    var prenom = document.getElementById('prenom');
    var naissance = document.getElementById('naiss');
    var email = document.getElementById('email');
    var tel = document.getElementById('tel');
    var choix = document.getElementsByName('choix'); //la div qui recupere le statut
    var typeBourse = document.getElementById('typeBourse'); //la div
    var batiment = document.getElementById('Batiment'); //la div
    var chambre;
    var adresse = document.getElementById('adresse'); //la div
    var sendForm = document.getElementById('subm');
    var nonBoursier = document.getElementById('nonBoursier');
    var loger = document.getElementById('Loger');
    var boursier = document.getElementById('Boursier');
    var ladresse = document.getElementById('ladresse');
    var lebatiment = document.getElementById('leBatiment');
    sendForm.addEventListener('click', validation);

    function validation(e) {
        nom.style.backgroundColor = '#fff';
        prenom.style.backgroundColor = '#fff';
        naissance.style.backgroundColor = '#fff';
        email.style.backgroundColor = '#fff';
        if (ladresse) ladresse.style.backgroundColor = '#fff';
        lebatiment.style.backgroundColor = '#fff';
        tel.style.backgroundColor = '#fff';

        if (nom.value == '') {
            nom.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            nom.setAttribute("placeholder", "Remplir le nom !");
            e.preventDefault();
        }
        if (prenom.value == '') {
            prenom.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            prenom.setAttribute("placeholder", "Remplir le prénom !");
            e.preventDefault();
        }
        if (naissance.value == '') {
            naissance.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            alert('Remplir la date de naissance !');
            e.preventDefault();
        }
        if (email.value == '') {
            email.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            email.setAttribute("placeholder", "Remplir l'email !");
            e.preventDefault();
        }
        if (tel.value == '') {
            tel.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            tel.setAttribute("placeholder", "Remplir le téléphone !");
            e.preventDefault();
        }
        if (!loger.checked && !nonBoursier.checked && !boursier.checked) {
            alert('Choisir une catégorie (boursier, loger ou non boursier)!');
            e.preventDefault();
        }

        if (nonBoursier.checked && ladresse.value == '') {
            ladresse.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            ladresse.setAttribute("placeholder", "Remplir l'adresse !");
            e.preventDefault();
        }

        if (lebatiment && lebatiment.selectedIndex == 0) {
            lebatiment.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            e.preventDefault();
        }

    }
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
    ////////////----Début popUp----////////
    var i = 0;
    var monPopUp = document.getElementById('popUp');

    function popUp() {
        i += 0.7;
        monPopUp.style.top = `${i}px`;
        if (window.getComputedStyle(monPopUp).top != '70px') requestAnimationFrame(popUp);
    }
    if (monPopUp) requestAnimationFrame(popUp);
    ////////////----Fin popUp----////////

}
////////////----Fin Page étudidant----////////

////////////----Début Page étudidant----////////
var nom_page = window.location.pathname;
if (nom_page.includes("bourses.php")) {

}