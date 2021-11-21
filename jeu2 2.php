<?php
require_once "includes/functions.php";
session_start();

// Si l'user n'est pas connecté
if(!isUserConnected())
    redirect('index.php');

?>
<script src="js/changerBg.js"></script>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/index2.css"/>
    <link rel="stylesheet" href="css/motscroises.css"/>
    <title>Mots croisés</title>
</head>
<body>
<script>
    var prenom = '<?php echo $_SESSION['prenom'] ?>';
    var couleur = '<?php echo $_SESSION['couleur'] ?>';

    changerBg(Number(couleur));
</script>
<a href="index.php" class="back">Abandonner</a>
<section class="d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <h1>Mots mélês</h1>
        <br/>
        <div id="resultat"></div>
        <div id="compteur"></div>
        <div id="aTrouver"></div>
        <script src="js/motscroises.js"></script>
        <br/>
    </div>
</section>

</body>
</html>