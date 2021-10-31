//Il manque :
//  Rien si on click sur la mauvaise image et temps si on click sur la bonne

//---------------------------------------------------------------------------------------------------------------------------------
//                                                          Paramètres du jeu
//---------------------------------------------------------------------------------------------------------------------------------

const nbnS = 38 ; // Nombre d'images non souriantes dans le dossier
const nbS= 8;  // Nombre d'images souriantes dans le dossier


//---------------------------------------------------------------------------------------------------------------------------------
//                                      Choisit la valeur aléatoire dans lequel il y a le sourire.
//---------------------------------------------------------------------------------------------------------------------------------
function entierAleatoire(min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

var sourireColonne = entierAleatoire(0,5);
var sourireLigne = entierAleatoire(0,5);
const numSourire = sourireLigne*6+sourireColonne; // Numéro de l'image, en lisant d'abord en ligne, puis en colonne (sens de lecture usuel pour le français)

//---------------------------------------------------------------------------------------------------------------------------------
//                          Compte à rebours en arrivant sur le page + crée le temps1 pour avoir le temps de réaction
//---------------------------------------------------------------------------------------------------------------------------------
var i=5;
const texte = document.querySelector('h2');
const texte2 = document.querySelector('h3');
intervalID = setInterval(function() {
    if (i>=0) {

        texte.innerText=i;
        i = i - 1;}
    else
    {
        var temps1 = new Date();
        temps1 = new Date().getTime();
        texte.innerText="A toi de jouer !";
        var el = document.querySelectorAll('.card')
        for (var j = 0; j < el.length; j++)
        {
            el[j].classList.remove('pasretourner');
            el[j].classList.add('retourner');
        }
    }
}, 1000);

/*---------------------------------------------------------------------------------------------------------------------------------
                                                    Avoir le temps de réaction
Rq : 7000, temps à calibrer
---------------------------------------------------------------------------------------------------------------------------------*/
function getTimer(event){
    var temps2 = new Date();
    temps2 = new Date().getTime();
    texte2.innerText= (temps2-now-7000)/1000 +"s";

}
/*---------------------------------------------------------------------------------------------------------------------------------
                                                  Tableau des images sans sourires
 ---------------------------------------------------------------------------------------------------------------------------------*/
var imagesNS =[]; //Images non souriantes
function nS(){ // Crée le tableau avec le chemin des images non souriantes
    for (var i=1;i<=nbnS;i++)
    {
        imagesNS.push('img/Jeu1/NoSourires/'+i+'.jpg')
    }
}

var imagesS =[]; //Images souriantes
function S(){ // Crée le tableau avec le chemin des images souriantes
    for (var i=1;i<nbS;i++)
    {
        imagesS.push('img/Jeu1/Sourires/'+i+'.jpg')
    }
}


/*---------------------------------------------------------------------------------------------------------------------------------
                                                    Fonction de mélange d'un tableau
 ---------------------------------------------------------------------------------------------------------------------------------*/

function shuffleArray(inputArray){
    inputArray.sort(()=> Math.random() - 0.5);
}
S();
nS();
var ligne = 0;
for (var k=0;k<=5;k++)
        {
            var numero = ligne*6+k;
            var div = document.createElement('div');
            div.setAttribute('class','card pasretourner');
            div.setAttribute("onclick","getTimer(event)")
            var imageu = document.createElement('img')
            if (numero==numSourire) // On a la case où on doit mettre l'image souriante
            {
                var imageSL1 =imagesS[1];
                imageu.setAttribute('src',imageSL1);
            }
            else // On doit mettre une image qui ne sourie pas
            {
                var imageNSL1 =imagesNS[numero];
                imageu.setAttribute('src',imageNSL1);
            }
            imageu.setAttribute('class','retourner card');
            div.appendChild(imageu);
            document.getElementById("1").appendChild(div)


        }
ligne = 1;
for (var k2=0;k2<=5;k2++)
{
    numero = ligne*6+k2;
    var divL2 = document.createElement('div');
    divL2.setAttribute('class','card pasretourner');
    divL2.setAttribute("onclick","getTimer(event)")
    var imageu2 = document.createElement('img')
    if (numero==numSourire) // On a la case où on doit mettre l'image souriante
    {
        var imageSL2 =imagesS[1];
        imageu2.setAttribute('src',imageSL2);
    }
    else // On doit mettre une image qui ne sourie pas
    {
        var imageNSL2 =imagesNS[numero];
        imageu2.setAttribute('src',imageNSL2);
    }
    imageu2.setAttribute('class','retourner card');
    divL2.appendChild(imageu2);
    document.getElementById("2").appendChild(divL2)


}
ligne = 2;
for (var k3=0;k3<=5;k3++)
{
    numero = ligne*6+k3;
    var divL3 = document.createElement('div');
    divL3.setAttribute('class','card pasretourner');
    divL3.setAttribute("onclick","getTimer(event)")
    var imageu3 = document.createElement('img')
    if (numero==numSourire) // On a la case où on doit mettre l'image souriante
    {
        var imageSL3 =imagesS[1];
        imageu3.setAttribute('src',imageSL3);
    }
    else // On doit mettre une image qui ne sourie pas
    {
        var imageNSL3 =imagesNS[numero];
        imageu3.setAttribute('src',imageNSL3);
    }
    imageu3.setAttribute('class','retourner card');
    divL3.appendChild(imageu3);
    document.getElementById("3").appendChild(divL3)


}
ligne = 3;
for (var k4=0;k4<=5;k4++)
{
    numero = ligne*6+k4;
    var divL4 = document.createElement('div');
    divL4.setAttribute('class','card pasretourner');
    divL4.setAttribute("onclick","getTimer(event)")
    var imageu4 = document.createElement('img')
    if (numero==numSourire) // On a la case où on doit mettre l'image souriante
    {
        var imageSL4 =imagesS[1];
        imageu4.setAttribute('src',imageSL4);
    }
    else // On doit mettre une image qui ne sourie pas
    {
        var imageNSL4 =imagesNS[numero];
        imageu4.setAttribute('src',imageNSL4);
    }
    imageu4.setAttribute('class','retourner card');
    divL4.appendChild(imageu4);
    document.getElementById("4").appendChild(divL4)


}
ligne = 4;
for (var k5=0;k5<=5;k5++)
{
    numero = ligne*6+k5;
    var divL5 = document.createElement('div');
    divL5.setAttribute('class','card pasretourner');
    divL5.setAttribute("onclick","getTimer(event)")
    var imageu5 = document.createElement('img')
    if (numero==numSourire) // On a la case où on doit mettre l'image souriante
    {
        var imageSL5 =imagesS[1];
        imageu5.setAttribute('src',imageSL5);
    }
    else // On doit mettre une image qui ne sourie pas
    {
        var imageNSL5 =imagesNS[numero];
        imageu5.setAttribute('src',imageNSL5);
    }
    imageu5.setAttribute('class','retourner card');
    divL5.appendChild(imageu5);
    document.getElementById("5").appendChild(divL5)


}
ligne = 5;
for (var k6=0;k6<=5;k6++)
{
    numero = ligne*6+k6;
    var divL6 = document.createElement('div');
    divL6.setAttribute('class','card pasretourner');
    divL6.setAttribute("onclick","getTimer(event)")
    var imageu6 = document.createElement('img')
    if (numero==numSourire) // On a la case où on doit mettre l'image souriante
    {
        var imageSL6 =imagesS[1];
        imageu6.setAttribute('src',imageSL6);
    }
    else // On doit mettre une image qui ne sourie pas
    {
        var imageNSL6 =imagesNS[numero];
        imageu6.setAttribute('src',imageNSL6);
    }
    imageu6.setAttribute('class','retourner card');
    divL6.appendChild(imageu6);
    document.getElementById("6").appendChild(divL6)


}
ligne = 6;