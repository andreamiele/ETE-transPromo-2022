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
    <title>ETƎ - Réglages</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/accueil.css"/>
</head>

<header>
    <a href="accueil.php"><img src="img/back.jpg" alt="Retour" class="deconnexion" style="width: 35px; left: 2%;"/></a>
</header>

<body style="background: linear-gradient(270deg, rgba(254, 225, 64, 0.76) 0%, rgba(250, 112, 154, 0.84) 100%)" >

<script>
    var couleur = '<?php echo $_SESSION['couleur'] ?>';
    changerBg(Number(couleur));
</script>

<img src="img/logo.png" alt="Logo" class="logo"/>

<section class="d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <h1>Réglages</h1>
        <br/>
        <form method="POST" action="reglages.php">
            <div class="form-group">
                <h2>Choisissez votre couleur...</h2>
                <label>
                    <input type="radio" name="couleur" value="1" style="visibility: hidden">
                    <div  class="btn btn-secondary bt1" onclick="changerBg(1)"></div>
                </label>
                <label>
                    <input type="radio" name="couleur" value="2" style="visibility: hidden">
                    <div  class="btn btn-secondary bt2" onclick="changerBg(2)"></div>
                </label><label>
                    <input type="radio" name="couleur" value="3" style="visibility: hidden">
                    <div  class="btn btn-secondary bt3" onclick="changerBg(3)"></div>
                </label>
                <label>
                    <input type="radio" name="couleur" value="4" style="visibility: hidden">
                    <div  class="btn btn-secondary bt4" onclick="changerBg(4)"></div>
                </label>
            </div>
            <div class="form-group">
                <h2>Choisissez votre avatar...</h2>
                <label>
                    <input type="radio" name="avatar" value="1">
                    <img src="avatars/1.jpg" style="width: 100px; height: 100px; border-radius: 100px; border: 2px solid white; cursor: pointer;">
                </label>
                <label>
                    <input type="radio" name="avatar" value="2">
                    <img src="avatars/2.jpg" style="width: 100px; height:  100px; border-radius: 100px; border: 2px solid white; cursor: pointer;">
                </label><label>
                    <input type="radio" name="avatar" value="3">
                    <img src="avatars/3.jpg" style="width: 100px; height:  100px; border-radius: 100px; border: 2px solid white; cursor: pointer;">
                </label>
                <label>
                    <input type="radio" name="avatar" value="4">
                    <img src="avatars/4.jpg" style="width: 100px; height:  100px; border-radius: 100px; border: 2px solid white; cursor: pointer;">
                </label>
            </div>
            <button type="submit" class="btn btn-primary" style="background: white; color: black;">EDITER</button>
        </form>
            <hr/>
        <form method="POST" action="supprimerCompte.php">
            <input type="hidden" name="delete" value="delete"/>
            <button type="submit" class="btn btn-3" style="font-size: 1em;" onclick="return confirm('Vous êtes sur le point de supprimer définitivement votre compte et ses données. Etes vous sûr ?');">SUPPRIMER MON COMPTE</button></a>
        </form>
    </div>
</section>

</body>

</html>

<?php

if (!empty($_POST['avatar']) or !empty($_POST['couleur'])) {
    $avatar = $_POST['avatar'];
    $couleur = $_POST['couleur'];
    $req = '';
    if(empty($_POST['avatar'])) {
        $req = getDb()->prepare('UPDATE users set couleur = ? where id=' . $_SESSION['id']);
        $req->execute(array($couleur));
        $_SESSION['couleur'] = $couleur;
    }
    else if(empty($_POST['couleur'])) {
        $req = getDb()->prepare('UPDATE users set avatar = ? where id=' . $_SESSION['id']);
        $req->execute(array($avatar));
        $_SESSION['avatar'] = $avatar;
    }
    else {
        $req = getDb()->prepare('UPDATE users set couleur = ?, avatar = ? where id=' . $_SESSION['id']);
        $req->execute(array($couleur, $avatar));
        $_SESSION['couleur'] = $couleur;
        $_SESSION['avatar'] = $avatar;
    }
    echo '<script type="text/JavaScript"> 
    window.location.replace("accueil.php");
     </script>';
}
?>