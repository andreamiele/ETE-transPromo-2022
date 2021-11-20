<?php
require_once "includes/functions.php";
session_start();

// Si l'user n'est pas connecté
if(!isUserConnected())
    redirect('index.php');

if(isset($_GET["jeu"]) && $_GET["jeu"] == 'motsCroises') {
        // Vérifier qu'aucune données n'est rentrée aujourd'hui avant de mettre
        $req = getDb()->prepare('UPDATE users set score = ? where id= ' . $_SESSION['id']);
        $nouveauScore = $_SESSION['score'] + $_GET['score'];
        $_SESSION['score'] = $nouveauScore;
        $req->execute(array($nouveauScore));
        // Plus qu'à mettre à jour la date, l'avancement, et matrice jeu croisés
        //$_GET['score']
        //$_GET['temps']
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
</head>

<body>
<script>
    var prenom = '<?php echo $_SESSION['prenom'] ?>';
    var couleur = '<?php echo $_SESSION['couleur'] ?>';

    changerBg(Number(couleur));
</script>
<img src="img/logo.png" alt="Logo" class="align-middle logo2"/>

<section class="">
    <a href="deconnexion.php">Deconnexion</a>

    <div class="row">
        <div class="2">
            <div class="bjr">
                <h1 class="bigbig" >BONJOUR, <?php echo $_SESSION['prenom'] ?></h1>
            </div>
        </div>

        <div class="col-md-4 ml-auto">
            <div class="">
                <button type="submit" class="btn btn-primary pts"><?php echo $_SESSION['score'] ?> SOLEILS</button>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="jour">C'EST VOTRE Y EME JOUR CONSECUTIF</h2>
        </div>
    </div>
    <br/>


    <div class="text-center">
        <button type="submit" class=" jouer btn btn-primary"> <h1>JOUER</h1></button>
    </div>
</section>
<script>
    function changerBg(param) {
        if(param === 1)
            document.body.style.background = 'linear-gradient(270deg, rgba(254, 225, 64, 0.76) 0%, rgba(250, 112, 154, 0.84) 100%)';
        if(param === 2)
            document.body.style.background = 'linear-gradient(90deg, #FC466B 0%, #3F5EFB 100%)';
        if(param === 3)
            document.body.style.background = 'linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%)';
        if(param === 4)
            document.body.style.background = 'linear-gradient(90deg, #4b6cb7 0%, #182848 100%)';
    }

</script>

</body>


</html>
