// Version 0.1 fonctionnelle : mots, grille, séléction, vérif, points, chrono
// Futures versions : mots en diagonales ? mots qui se croisent ? mots trouvés sur la grille à "barrer" ?

// ----- On stock les différents div où vont se trouver la grille et les mots à trouver
// ----- On cache le mot croisé pour le chrono
const divResultat = document.querySelector("#resultat");
const divATrouver = document.querySelector("#aTrouver");
document.getElementById("resultat").style.visibility = "hidden";

// ----- Déclarations de différentes variables pour le jeu
var temps1 = new Date();
var temps2 = new Date();
var tempsFinal = new Date();
var nbSoleils = 0;
var cpt = 5;

// ----- Chrono de 5 secondes, on rend visible ensuite et stock la date
timer = setInterval(function(){
    if(cpt > 0) {
        --cpt;
        document.getElementById("compteur").innerHTML =  cpt+'...';
    }else {
        clearInterval(timer);
        document.getElementById("resultat").style.visibility = "visible";
        document.getElementById("compteur").style.visibility = "hidden";
        temps1 = new Date().getTime();
    }
}, 1000);

// ----- Génére un tableau de mot 10*10 rempli de 0
var lesMots = new Array(10).fill(0);
for (var i = 0; i < 10; i++) {
    lesMots[i] = new Array(10).fill(0);
}

// ----- Dictionnaire de mots positifs de -12 lettres (à faire par la team recherche)
var motsPositifs = ['sourire', 'content', 'humour', 'amical', 'social', 'accepte', 'positif', 'reussite', 'succes', 'sympa', 'agreable', 'plaisant'];
var motUtilisateur = prenom.toLowerCase();

// ----- Mots trouvés par le joueur
var motsTrouves = [];

// ----- Placer 6 mots positifs aléatoires dans la grille (variable lesMots)
var motsPlaces = [];
while (motsPlaces.length < 6) {
    // Si on le place horizontal ou vertical
    var pileFace = Math.random();
    var horizontale = true;
    if(pileFace >= 0.5)
        horizontale = false;

    // On prend un mot au hasard dans les mots positifs, on vérifie qu'il n'a pas déjà été placé
    var alea = choisirUnMot(motsPlaces, motsPositifs);

    // On place ce mot
    placerUnMot(motsPositifs[alea]);
}

// ----- On ajoute le mot de l'utilisateur
var res;
do {
    // Tant qu'on ne peut pas le placer par manque de place, on recommance
    res = placerUnMot(motUtilisateur);
}
while( res === false)

// ----- On rempli le tableau avec des lettres aléatoires
lesMots = remplirLettres(lesMots);

// ----- On affiche le tableau
var html = "";
for(var i = 0; i < lesMots.length; i++) {
    html += "";
    for(var j = 0; j < lesMots[i].length; j++) {
        html += "<button type='submit' class='btn-mot' id='"+i.toLocaleString('fr-FR', {minimumIntegerDigits: 2, useGrouping:false}) + j.toLocaleString('fr-FR', {minimumIntegerDigits: 2, useGrouping:false})+"' onclick='selectionnerLettre(event)'>"+ lesMots[i][j] +"</button>";
    }
    html += " <br/>";
}
divResultat.innerHTML = html;
actualiserAffichage();

// ----- FONCTIONS -----

// ----- Permet de choisir un mot dans la liste du dico des mots positifs par un aléatoire
function choisirUnMot(motsPlaces, motsPositifs) {
    var motPasEncoreChoisi;
    var alea;
    do {
        motPasEncoreChoisi = true;
        alea = Math.floor((Math.random()*motsPositifs.length));
        for(var i = 0; i < motsPlaces.length; i++) {
            if(motsPlaces[i] === motsPositifs[alea])
                motPasEncoreChoisi = false;
        }
    }while (motPasEncoreChoisi === false)
    return alea;
}

// ----- Permet de vérifier si un mot peut rentrer dans une ligne, et qu'il n'y a pas déjà un mot
function verifierLigne(lesMots, xDepart, yDepart, longueurMot) {
    var verif = true;
    for(var j = yDepart; j < longueurMot+yDepart; j++) {
        if(Number(lesMots[xDepart][j]) !== Number(0))
            verif = false;
    }
    return verif;
}

// ----- Permet de vérifier si un mot peut rentrer dans une colonne, et qu'il n'y a pas déjà un mot
function verifierColonne(lesMots, xDepart, yDepart, longueurMot) {
    var verif = true;
    for(var j = xDepart; j < longueurMot+xDepart; j++) {
        if(Number(lesMots[j][yDepart]) !== Number(0))
            verif = false;
    }
    return verif;
}

// ----- Permet de placer un mot en faisant attention à la taille et la manière de le placer dans la grille
function placerUnMot(mot) {
    // variable de sécurité
    var secuTours = 0;
    // On regarde d'abord la taille du mot pour le placer de manière à ce qu'il rentre dans la grille
    var tailleMotAPlace = mot.length;
    var departPossible = 10 - tailleMotAPlace;
    // On choisit une coordonnée de départ au hasard dans l'intervalle possible, il faut que les cases soient vides
    var xDepart = 0;
    var yDepart = 0;
    var coordonneesValides = false;
    while(coordonneesValides === false && secuTours < 1000) {
        if(horizontale === true) {
            xDepart = Math.floor((Math.random()*10));
            yDepart = Math.floor((Math.random()*departPossible));
        }else {
            xDepart = Math.floor((Math.random()*departPossible));
            yDepart = Math.floor((Math.random()*10));
        }
        // On vérifie que toutes les cases sont ok
        if(Number(lesMots[xDepart][yDepart]) === Number(0)) {
            if (horizontale === true && verifierLigne(lesMots, xDepart, yDepart, tailleMotAPlace) === true) {
                coordonneesValides = true;
            } else if (horizontale === false && verifierColonne(lesMots, xDepart, yDepart, tailleMotAPlace) === true) {
                coordonneesValides = true;
            }
        }
        // SI la boucle fait trop de tours on change le mot
        secuTours +=1;
    }
    if(secuTours > 1000)
        return false;

    // On place horizontalement
    if(horizontale === true) {
        var cpt = 0;
        for(var j = yDepart; j < tailleMotAPlace+yDepart; j++) {
            lesMots[xDepart][j] = mot[cpt];
            cpt += 1;
        }
    }else { // On place verticalement
        var cpt = 0;
        for(var j = xDepart; j < tailleMotAPlace+xDepart; j++) {
            lesMots[j][yDepart] = mot[cpt];
            cpt += 1;
        }
    }
    // On indique que ce mot est placé
    motsPlaces.push(mot);
    return true;
}

// ----- Remplir les cases vides avec des lettres aléatoires
function remplirLettres(grille) {
    for(var i = 0; i < grille.length; i++) {
        for(var j = 0; j < grille[i].length; j++) {
            var lettres = "abcdefghijklmnopqrstuvwxyz";
            var rand = Math.floor(Math.random()*lettres.length);
            if(grille[i][j] === 0)
                grille[i][j] = lettres[rand];
        }
    }
    return grille;
}

var motEnCours = "";
var coordonneesX = -1; // Coordonnées x de la lettre précédente
var coordonneesY = -1; // Coordonnées y de la lettre précédente

// ----- Détection sélection de mot par l'user, chaque lettre a sa coordonnée en 2 digits (exemple 0000 (xx, yy)pour la lettre en haut à gauche)
function selectionnerLettre(e) {
    var ajouter = false;
    var coordonneesXNow = 0;
    var coordonneesYNow = 0;
    if(e.target.style.backgroundColor !== "white") {
        e.target.style = "background-color: white;";
        coordonneesXNow = parseInt(e.target.id.toString().substr(0,2));
        coordonneesYNow = parseInt(e.target.id.toString().substr(2,2));
        if(coordonneesX > -1 && coordonneesY > -1) {
            // pour l'instant sélection TOUT AUTOUR DE LA LETTRE tt le temps : à corriger si le temps
            if(Number(coordonneesX) - Number(coordonneesXNow) === Number(0) || Number(coordonneesX) - Number(coordonneesXNow) === Number(1) || Number(coordonneesX) - Number(coordonneesXNow) === Number(-1)) {
                if(Number(coordonneesY) - Number(coordonneesYNow) === Number(0) || Number(coordonneesY) - Number(coordonneesYNow) === Number(1) || Number(coordonneesY) - Number(coordonneesYNow) === Number(-1)) {
                    // Si les coordonnées sont exactes
                    ajouter = true;
                }
            }
        }else {
            ajouter = true;
        }
    }

    if(ajouter === true) {
        motEnCours += e.target.innerHTML;
        coordonneesX = coordonneesXNow;
        coordonneesY = coordonneesYNow;
        if(verifierMot() === true) {
            ajouter = false;
            actualiserAffichage();
        }
    }if(ajouter === false){
        motEnCours = "";
        coordonneesX = -1;
        coordonneesY = -1;
        var lesBoutons = document.getElementsByClassName('btn-mot');
        for (var i = 0 ; i < lesBoutons.length ; i++) {
            lesBoutons[i].style.backgroundColor = '#FEC5BB';
        }
    }
}

// ----- Vérification du mot séléctionné par l'user
function verifierMot() {
    var indicateur = true;
    if(motsTrouves.length !== motsPlaces.length) {
        for(var i = 0; i < motsPlaces.length; i++) {
            if(motsPlaces[i] === motEnCours) {
                for(var j = 0; j < motsTrouves.length; j++) {
                    if(motsTrouves[j] === motEnCours) {
                        indicateur = false;
                    }
                }
                if(indicateur === true) {
                    motsTrouves.push(motEnCours);
                    if(motsTrouves.length === motsPlaces.length)
                        partieTerminee();
                    return true;
                }
            }
        }
        return false;
    }else
        partieTerminee();
}

// ----- Fonction qui permet d'actualiser la liste des mots à trouver
function actualiserAffichage() {
    var text = "<p class='mots'> <i>Les mots à trouver sont </i>: ";
    for(var i = 0; i < motsPlaces.length; i++) {
        var indicateur = false;
        for(var j = 0; j < motsTrouves.length; j++) {
            if(motsPlaces[i] === motsTrouves[j])
                indicateur = true;
        }
        if(indicateur === false)
            text += "<b><span class='caps'>"+ motsPlaces[i] + "</span></b> ";
    }
    text += "</p>"
    divATrouver.innerHTML = text;
}

// ----- Fonction qui gère une fois que la partie est terminée (temps, points...)
function partieTerminee() {
    temps2 = new Date().getTime();
    tempsFinal = (temps2 - temps1)*0.001; // temps en secondes
    alert("Bravo ! En " + tempsFinal + " secondes !");
    nbSoleils = Math.floor(1200/tempsFinal);
    if(nbSoleils < 1)
        nbSoleils = 1;
    alert("Vous gagnez " + nbSoleils + " soleils !");
    // Envoyer le score et le temps
    document.location.href="accueil.php?score=" + nbSoleils + "&temps=" + tempsFinal + "&jeu=motsCroises";
}

