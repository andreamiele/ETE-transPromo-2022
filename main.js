//Il manque :
//  -la fin du compteur de temps
//  - l'animation pour se retourner
//  - la fin du chronomètre quand il click sur la bonne page
//  -

const divResultat = document.querySelector("#resultat");

var tabJeu = [
    [0,0,0,0,0,0],
    [0,0,0,0,0,0],
    [0,0,1,0,0,0],
    [0,0,0,0,0,0],
    [0,0,0,0,0,0],
    [0,0,0,0,0,0],
]



// Crée un tableau de valeur aléatoire
var tabJeu2 = [
    Array.apply(null, Array(6)).map(function() { return Math.floor(Math.random() * 100 % 100); }),
    Array.apply(null, Array(6)).map(function() { return Math.floor(Math.random() * 100 % 100); }),
    Array.apply(null, Array(6)).map(function() { return Math.floor(Math.random() * 100 % 100); }),
    Array.apply(null, Array(6)).map(function() { return Math.floor(Math.random() * 100 % 100); }),
    Array.apply(null, Array(6)).map(function() { return Math.floor(Math.random() * 100 % 100); }),
    Array.apply(null, Array(6)).map(function() { return Math.floor(Math.random() * 100 % 100); }),
];

// Choisit la valeur aléatoire dans lequel il y a le sourire.

var sourireColonne = entierAleatoire(0,5);
var sourireLigne = entierAleatoire(0,5);
var sourireValeur = tabJeu2[sourireLigne][sourireColonne];



afficherTableau();

function afficherTableau(){
    var txt ="";
    var compteur=0;

    for(var i=0;i <tabJeu.length;i++)
    {
        txt +="<div>";
        for(var j=0;j<tabJeu[i].length;j++)
        {
            if((i==sourireColonne)&&(j==sourireLigne)) {
                txt += "<button id ='bonbouton' class='btn btn-primary m-2' style='width:100px;height:100px'> oui </button>";
            }
            else
            {
                txt +=jArray[compteur];
                compteur = compteur +1;
            }
        }
    txt +="</div>";
    }

    divResultat.innerHTML = txt;
}


function entierAleatoire(min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Compte à rebours en arrivant sur le page

var i=5;
const texte = document.querySelector('h2');

intervalID = setInterval(function() {

    //alert(coucou[i].innerHTML);
    if (i>=0) {

        texte.innerText=i;
    i = i - 1;}
    else {
        temps1 = new Date().getTime()
        texte.innerText="A toi de jouer !";
    }


}, 1000);

var temps1 = new Date();
var temps2 = new Date();

function getTimer(){
    temps2 = new Date().getTime();
    texte.innerText=temps2-temps1+"s";
}




