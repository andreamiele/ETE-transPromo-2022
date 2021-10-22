// Reste à faire :
// remplir avec des lettres aléatoirement
// chrono
// sélectionner des mots
// vérifier la selection et valider ou non
// système de points

const divResultat = document.querySelector("#resultat");

// Générer un tableau de mot 13*13 rempli de 0
var lesMots = new Array(13).fill(0);
for (var i = 0; i < 13; i++) {
    lesMots[i] = new Array(13).fill(0);
}

// Dictionnaire de mots positifs de -12 lettres (à faire par la team recherche)
var motsPositifs = ['sourire', 'content', 'humour', 'amical', 'social', 'accepte', 'positif', 'reussite', 'succes', 'sympa', 'agreable', 'plaisant'];
var motUtilisateur = 'arnaud';

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


// On affiche le tableau
var html = "";
for(var i = 0; i < lesMots.length; i++) {
    html += "[ ";
    for(var j = 0; j < lesMots[i].length; j++) {
        html += "["+ lesMots[i][j] +"]";
    }
    html += " ] <br/>";
}
divResultat.innerHTML = html;

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