<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>ETƎ - SMILE</title>
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/index2.css"/>
    <link rel="stylesheet" href="css/Jeu1.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body style="background: linear-gradient(270deg, rgba(254, 225, 64, 0.76) 0%, rgba(250, 112, 154, 0.84) 100%)" onLoad="setTimeout('Redirection()',67000)">
<a href="index.php" class="back">Abandonner</a>

<div class="container-fluid">
    <h2 class="text-center"></h2> <!-- Compteur -->
    <h3></h3> <!-- Temps de réaction -->
</div>

<div class="scene center" id="Grille">
  <div class="betom" id="1">

  </div>
  <h3 class="fixed-top text-center"></h3>
  <div class="betom" id="2">

  </div>
  <div class="betom" id="3">

  </div>
  <div class="betom" id="4">

  </div>
  <div class="betom" id="5">

  </div>
  <div class="betom" id="6">

  </div>
</div>


<script >
  var now = new Date().getTime();

  /*---------------------------------------------------------------------------------------------------------------------------------
                                            Redirection vers la page d'accueil après 1 minute.
  --------------------------------------------------------------------------------------------------------------------------------- */
function Redirection()
{
    document.location.href="accueil.php"
}
  /*---------------------------------------------------------------------------------------------------------------------------------
                                            Refresh la div après avoir trouvé le bon visage
    --------------------------------------------------------------------------------------------------------------------------------- */
  function updateDiv()
  {
      $( "#Grille" ).load(window.location.href + " #Grille" );
  }


  //---------------------------------------------------------------------------------------------------------------------------------
  //                                                          Paramètres du jeu
  //---------------------------------------------------------------------------------------------------------------------------------

  let tab_timing = []; // Temps pour chaque visage
  var compteur_visage = 0;
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
  //                           + compte à rebours de la minute de jeu.
  //---------------------------------------------------------------------------------------------------------------------------------
  var i=5;
  var timer=60;
  const texte = document.querySelector('h2');
  const texte2 = document.querySelector('h3');
  intervalID = setInterval(function() {
      if (i>=0) {

          texte.innerText=i;
          i = i - 1;}
      else
      {
        if (timer==60){
            var temps1 = new Date();
            temps1 = new Date().getTime();
            texte.innerText="Trouve le maximum de visages souriants en une minute.";
            timer=timer-1
        }
         else {
            texte.innerText=timer;
            timer=timer-1
        }

          var el = document.querySelectorAll('.card')
          for (var j = 0; j < el.length; j++)
          {
              el[j].classList.remove('pasretourner');
              el[j].classList.add('retourner');
          }
      }
  }, 1000);
var a = new Date().getTime();
a=a+7000;
var temps2 = new Date();
  /*---------------------------------------------------------------------------------------------------------------------------------
                                                      Avoir le temps de réaction
  Rq : 7000ms, temps à calibrer
  ---------------------------------------------------------------------------------------------------------------------------------*/
  function getTimer(event){
      temps2 = new Date().getTime();

      texte2.innerText= (temps2-a)/1000 +"s";
      tab_timing.push((temps2-a)/1000);
      a = new Date().getTime();
      compteur_visage++;
      Construction2();


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
  /*---------------------------------------------------------------------------------------------------------------------------------
                                                      Tableau des images sourires
     ---------------------------------------------------------------------------------------------------------------------------------*/

  var imagesS =[]; //Images souriantes
  function S(){ // Crée le tableau avec le chemin des images souriantes
      for (var i=1;i<nbS;i++)
      {
          imagesS.push('img/Jeu1/Sourires/'+i+'.jpg')
      }
  }

  S();
  nS();
  Construction();

  /*---------------------------------------------------------------------------------------------------------------------------------
                                                      Fonction de mélange d'un tableau
   ---------------------------------------------------------------------------------------------------------------------------------*/

  function shuffleArray(inputArray){
      inputArray.sort(()=> Math.random() - 0.5);
  }

  /*---------------------------------------------------------------------------------------------------------------------------------
                                                       Construction de la grille à l'arrivée sur la page de Jeu
                                                        -on n'a encore trouvé aucun visage-
    ---------------------------------------------------------------------------------------------------------------------------------*/
  function Construction() {

      imagesNS =[];
      imagesS =[]; //Images souriantes
      S();
      nS();

      var sourireColonne = entierAleatoire(0,5);
      var sourireLigne = entierAleatoire(0,5);
      const numSourire = sourireLigne*6+sourireColonne; // Numéro de l'image, en lisant d'abord en ligne, puis en colonne (sens de lecture usuel pour le français)


      var ligne = 0;
      for (var k = 0; k <= 5; k++) {
          var numero = ligne * 6 + k;
          var div = document.createElement('div');
          div.setAttribute('class', 'card pasretourner');

          var imageu = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              div.setAttribute("onclick", "getTimer(event)");
              var imageSL1 = imagesS[1];
              imageu.setAttribute('src', imageSL1);
          } else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL1 = imagesNS[numero];
              imageu.setAttribute('src', imageNSL1);
          }
          imageu.setAttribute('class', 'retourner card sheesh');
          div.appendChild(imageu);
          document.getElementById("1").appendChild(div)
      }
      ligne = 1;
      for (var k2 = 0; k2 <= 5; k2++) {
          numero = ligne * 6 + k2;
          var divL2 = document.createElement('div');
          divL2.setAttribute('class', 'card pasretourner');
          var imageu2 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL2.setAttribute("onclick", "getTimer(event)");
              var imageSL2 = imagesS[1];
              imageu2.setAttribute('src', imageSL2);
          }
          else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL2 = imagesNS[numero];
              imageu2.setAttribute('src', imageNSL2);
          }
          imageu2.setAttribute('class', 'retourner card sheesh');
          divL2.appendChild(imageu2);
          document.getElementById("2").appendChild(divL2)
      }
      ligne = 2;
      for (var k3 = 0; k3 <= 5; k3++) {
          numero = ligne * 6 + k3;
          var divL3 = document.createElement('div');
          divL3.setAttribute('class', 'card pasretourner');
          var imageu3 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL3.setAttribute("onclick", "getTimer(event)");
              var imageSL3 = imagesS[1];
              imageu3.setAttribute('src', imageSL3);
          }
          else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL3 = imagesNS[numero];
              imageu3.setAttribute('src', imageNSL3);
          }
          imageu3.setAttribute('class', 'retourner card sheesh');
          divL3.appendChild(imageu3);
          document.getElementById("3").appendChild(divL3)


      }
      ligne = 3;
      for (var k4 = 0; k4 <= 5; k4++) {
          numero = ligne * 6 + k4;
          var divL4 = document.createElement('div');
          divL4.setAttribute('class', 'card pasretourner');
          var imageu4 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL4.setAttribute("onclick", "getTimer(event)");
              var imageSL4 = imagesS[1];
              imageu4.setAttribute('src', imageSL4);
          }
          else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL4 = imagesNS[numero];
              imageu4.setAttribute('src', imageNSL4);
          }
          imageu4.setAttribute('class', 'retourner card sheesh');
          divL4.appendChild(imageu4);
          document.getElementById("4").appendChild(divL4)


      }
      ligne = 4;
      for (var k5 = 0; k5 <= 5; k5++) {
          numero = ligne * 6 + k5;
          var divL5 = document.createElement('div');
          divL5.setAttribute('class', 'card pasretourner');
          var imageu5 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL5.setAttribute("onclick", "getTimer(event)");
              var imageSL5 = imagesS[1];
              imageu5.setAttribute('src', imageSL5);
          }
          else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL5 = imagesNS[numero];
              imageu5.setAttribute('src', imageNSL5);
          }
          imageu5.setAttribute('class', 'retourner card sheesh');
          divL5.appendChild(imageu5);
          document.getElementById("5").appendChild(divL5)


      }
      ligne = 5;
      for (var k6 = 0; k6 <= 5; k6++) {
          numero = ligne * 6 + k6;
          var divL6 = document.createElement('div');
          divL6.setAttribute('class', 'card pasretourner');
          var imageu6 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL6.setAttribute("onclick", "getTimer(event)");
              var imageSL6 = imagesS[1];
              imageu6.setAttribute('src', imageSL6);
          }
          else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL6 = imagesNS[numero];
              imageu6.setAttribute('src', imageNSL6);
          }
          imageu6.setAttribute('class', 'retourner card sheesh');
          divL6.appendChild(imageu6);
          document.getElementById("6").appendChild(divL6)


      }
      ligne = 6;
  }
  /*---------------------------------------------------------------------------------------------------------------------------------
                                                     Fonction de refresh de la grille après click
  ---------------------------------------------------------------------------------------------------------------------------------*/

  function Construction2() {
      //Supprimer l'ancienne grille
      var divi = document.getElementById("1");
      while (divi.firstChild) {
          divi.removeChild(divi.lastChild);
      }
      divi = document.getElementById("2");
      while (divi.firstChild) {
          divi.removeChild(divi.lastChild);
      }
      divi = document.getElementById("3");
      while (divi.firstChild) {
          divi.removeChild(divi.lastChild);
      }
      divi = document.getElementById("4");
      while (divi.firstChild) {
          divi.removeChild(divi.lastChild);
      }
      divi = document.getElementById("5");
      while (divi.firstChild) {
          divi.removeChild(divi.lastChild);
      }
      divi = document.getElementById("6");
      while (divi.firstChild) {
          divi.removeChild(divi.lastChild);
      }

      // Implémentation de la nouvelle
      imagesNS =[];
      imagesS =[]; //Images souriantes
      S();
      nS();

      var sourireColonne = entierAleatoire(0,5);
      var sourireLigne = entierAleatoire(0,5);
      const numSourire = sourireLigne*6+sourireColonne; // Numéro de l'image, en lisant d'abord en ligne, puis en colonne (sens de lecture usuel pour le français)

      var ligne = 0;
      for (var k = 0; k <= 5; k++) {
          var numero = ligne * 6 + k;
          var div = document.createElement('div');
          div.setAttribute('class', 'card pasretourner');

          var imageu = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              div.setAttribute("onclick", "getTimer(event)");
              var imageSL1 = imagesS[1];
              imageu.setAttribute('src', imageSL1);
          } else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL1 = imagesNS[numero];
              imageu.setAttribute('src', imageNSL1);
          }
          imageu.setAttribute('class', 'retourner card sheesh');
          div.appendChild(imageu);
          document.getElementById("1").appendChild(div)


      }
      ligne = 1;
      for (var k2 = 0; k2 <= 5; k2++) {
          numero = ligne * 6 + k2;
          var divL2 = document.createElement('div');
          divL2.setAttribute('class', 'card pasretourner');
          var imageu2 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL2.setAttribute("onclick", "getTimer(event)");
              var imageSL2 = imagesS[1];
              imageu2.setAttribute('src', imageSL2);
          } else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL2 = imagesNS[numero];
              imageu2.setAttribute('src', imageNSL2);
          }
          imageu2.setAttribute('class', 'retourner card sheesh');
          divL2.appendChild(imageu2);
          document.getElementById("2").appendChild(divL2)


      }
      ligne = 2;
      for (var k3 = 0; k3 <= 5; k3++) {
          numero = ligne * 6 + k3;
          var divL3 = document.createElement('div');
          divL3.setAttribute('class', 'card pasretourner');
          var imageu3 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL3.setAttribute("onclick", "getTimer(event)");
              var imageSL3 = imagesS[1];
              imageu3.setAttribute('src', imageSL3);
          } else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL3 = imagesNS[numero];
              imageu3.setAttribute('src', imageNSL3);
          }
          imageu3.setAttribute('class', 'retourner card sheesh');
          divL3.appendChild(imageu3);
          document.getElementById("3").appendChild(divL3)


      }
      ligne = 3;
      for (var k4 = 0; k4 <= 5; k4++) {
          numero = ligne * 6 + k4;
          var divL4 = document.createElement('div');
          divL4.setAttribute('class', 'card pasretourner');
          var imageu4 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL4.setAttribute("onclick", "getTimer(event)");
              var imageSL4 = imagesS[1];
              imageu4.setAttribute('src', imageSL4);
          } else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL4 = imagesNS[numero];
              imageu4.setAttribute('src', imageNSL4);
          }
          imageu4.setAttribute('class', 'retourner card sheesh');
          divL4.appendChild(imageu4);
          document.getElementById("4").appendChild(divL4)


      }
      ligne = 4;
      for (var k5 = 0; k5 <= 5; k5++) {
          numero = ligne * 6 + k5;
          var divL5 = document.createElement('div');
          divL5.setAttribute('class', 'card pasretourner');
          var imageu5 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL5.setAttribute("onclick", "getTimer(event)");
              var imageSL5 = imagesS[1];
              imageu5.setAttribute('src', imageSL5);
          } else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL5 = imagesNS[numero];
              imageu5.setAttribute('src', imageNSL5);
          }
          imageu5.setAttribute('class', 'retourner card sheesh');
          divL5.appendChild(imageu5);
          document.getElementById("5").appendChild(divL5)


      }
      ligne = 5;
      for (var k6 = 0; k6 <= 5; k6++) {
          numero = ligne * 6 + k6;
          var divL6 = document.createElement('div');
          divL6.setAttribute('class', 'card pasretourner');
          var imageu6 = document.createElement('img')
          if (numero == numSourire) // On a la case où on doit mettre l'image souriante
          {
              divL6.setAttribute("onclick", "getTimer(event)");
              var imageSL6 = imagesS[1];
              imageu6.setAttribute('src', imageSL6);
          } else // On doit mettre une image qui ne sourie pas
          {
              var imageNSL6 = imagesNS[numero];
              imageu6.setAttribute('src', imageNSL6);
          }
          imageu6.setAttribute('class', 'retourner card sheesh');
          divL6.appendChild(imageu6);
          document.getElementById("6").appendChild(divL6)


      }
      ligne = 6;
  }

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>