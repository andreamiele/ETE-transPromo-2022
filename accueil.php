<?php
require_once "includes/functions.php";
session_start();

// Si l'user n'est pas connecté
if(!isUserConnected())
    redirect('index.php');

// Système d'ajout des données une fois que le jeu est terminé
if(isset($_GET["jeu"]) && $_GET["jeu"] == 'motsCroises') {
    inscrireDonnees(0);
}else if(isset($_GET["jeu"]) && $_GET["jeu"] == 'matrice') {
    inscrireDonnees(1);
}
?>
<script src="js/changerBg.js"></script>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>ETƎ - Accueil</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index2.css"/>
    <link rel="stylesheet" href="css/accueil.css"/>
    <link rel="stylesheet" href="css/soleilfall.css"/>
</head>

<body>

<header>
    <a href="deconnexion.php"><img src="img/deconnexion.png" alt="Deconnexion" class="deconnexion"/></a>
    <a href="reglages.php"><img src="img/settings.png" alt="Réglages" class="settings"/></a>
</header>
<div class="loader">
    <?php for($i = 0; $i < $_SESSION['score']; $i++)
        echo '<span></span>'?>
</div>
<section class="d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <p class="profilText"><img src="avatars/<?php echo $_SESSION['avatar']?>.jpg" alt="Profil" class="profil"/>Bonjour, <?php echo $_SESSION['prenom'] ?>.</p>
        <p class="bjr">Nous sommes heureux de vous retrouver, il s'agit de votre <span style="color: yellow; font-weight: bold"><?php echo $_SESSION['nbJours'] ?></span> jour(s) consécutif(s) avec nous !</p>
        <br/>
        <hr/>
        <?php if($_SESSION['avancementJeu'] < 2) {?>
        <p class="bjr2">Votre entraînement d'aujourd'hui est prêt...</p>
            <?php
            $ordre = 1;
            if(date(d)%2==0) {
                $ordre = 0;
            }
            ?>
        <button type="submit" class="jouer btn btn-primary" onclick="Randomisation(<?php echo $ordre ?>, <?php echo $_SESSION['avancementJeu'] ?>)">JOUER <?php echo $_SESSION['avancementJeu']?>/2</button>
        <?php }else {?>
            <p class="bjr2">Mission remplie pour aujourd'hui ! A demain pour remporter encore plus de soleils &hearts; .</p>
        <?php } ?>
    </div>
</section>
<script>
    var prenom = '<?php echo $_SESSION['prenom'] ?>';
    var couleur = '<?php echo $_SESSION['couleur'] ?>';

    changerBg(Number(couleur));
</script>
<img src="img/logo.png" alt="Logo" class="align-middle logo2"/>
<p class="soleils">Vous avez décroché <span style="color: yellow; font-weight: bold"><?php echo $_SESSION['score'] ?> </span>soleil(s) en tout ! </p>
<script>
    // L'ordre des jeux dépendra du jour si il est pair ou non, ça nous permettra de faciliter
    // le fait que ce soit le jeu 1 ou le jeu 2 en premier (économie de ligne)
    function Randomisation(ordre, avancement){
        // Si jour pair et pas d'avancement
        if(ordre%2===0 && avancement === 0)
            document.location.href="jeu1.php"
        // Si jour pair et avancement
        if(ordre%2===0 && avancement === 1)
            document.location.href="jeu2.php"
        // Si jour impair et pas d'avancement
        if(ordre%2!==0 && avancement === 0)
            document.location.href="jeu2.php"
        // Si jour impair et avancement
        if(ordre%2!==0 && avancement === 1)
            document.location.href="jeu1.php"
    }
</script>

</body>


</html>
