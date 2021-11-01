// sélectionner des mots
// chrono
// vérifier la selection et valider ou non
// système de points

const divResultat = document.querySelector("#resultat");
const divATrouver = document.querySelector("#aTrouver");

// Générer un tableau de mot 13*13 rempli de 0
var lesMots = new Array(13).fill(0);
for (var i = 0; i < 13; i++) {
    lesMots[i] = new Array(13).fill(0);
}

// Dictionnaire de mots positifs de -12 lettres (à faire par la team recherche)
var motsPositifs = ['sourire', 'content', 'humour', 'amical', 'social', 'accepte', 'positif', 'reussite', 'succes', 'sympa', 'agreable', 'plaisant'];
var motUtilisateur = 'arnaud';

// Mots trouvés par le joueur
var motsTrouves = [];

// Placer 7 mots positifs aléatoires dans la grille
var motsPlaces = [];
while (motsPlaces.length < 7) {
    // Si on le place horizontal ou vertical
    var pileFace = Math.random();
    var horizontale = true;
    if(pileFace >= 0.5)
        horizontale = false;

    // On prend un mot au hasard dans les mots positifs, on vérifie qu'il n'a pas déjà été placé
    var alea = choisirUnMot(motsPlaces, motsPositifs);

    placerUnMot(motsPositifs[alea]);
}
// On ajoute le mot de l'utilisateur
var res;
do {
    res = placerUnMot(motUtilisateur);
}
while( res === false)

// On rempli le tableau avec des lettres aléatoires
lesMots = remplirLettres(lesMots);

// On affiche le tableau
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

function verifierLigne(lesMots, xDepart, yDepart, longueurMot) {
    var verif = true;
    for(var j = yDepart; j < longueurMot+yDepart; j++) {
        if(Number(lesMots[xDepart][j]) !== Number(0))
            verif = false;
    }
    return verif;
}

function verifierColonne(lesMots, xDepart, yDepart, longueurMot) {
    var verif = true;
    for(var j = xDepart; j < longueurMot+xDepart; j++) {
        if(Number(lesMots[j][yDepart]) !== Number(0))
            verif = false;
    }
    return verif;
}

function placerUnMot(mot) {
    // variable de sécurité
    var secuTours = 0;
    // On regarde d'abord la taille du mot pour le placer de manière à ce qu'il rentre dans la grille
    var tailleMotAPlace = mot.length;
    var departPossible = 13 - tailleMotAPlace;
    // On choisit une coordonnée de départ au hasard dans l'intervalle possible, il faut que les cases soient vides
    var xDepart = 0;
    var yDepart = 0;
    var coordonneesValides = false;
    while(coordonneesValides === false && secuTours < 1000) {
        if(horizontale === true) {
            xDepart = Math.floor((Math.random()*13));
            yDepart = Math.floor((Math.random()*departPossible));
        }else {
            xDepart = Math.floor((Math.random()*departPossible));
            yDepart = Math.floor((Math.random()*13));
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

// Détection sélection de mot, chaque lettre a sa coordonnée en 2 digits (exemple 0000 (xx, yy)pour la lettre en haut à gauche)
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
                        alert("Partie terminée !")
                    return true;
                }
            }
        }
        return false;
    }else {
        alert("Partie terminée !")
    }
}

function actualiserAffichage() {
    var text = "<p class='mots'> Les mots à trouver sont : ";
    for(var i = 0; i < motsPlaces.length; i++) {
        var indicateur = false;
        for(var j = 0; j < motsTrouves.length; j++) {
            if(motsPlaces[i] === motsTrouves[j])
                indicateur = true;
        }
        if(indicateur === false)
            text += "<b>"+ motsPlaces[i] + "</b> ";
    }
    text += "</p>"
    divATrouver.innerHTML = text;
}


