<?php
require_once "includes/functions.php";
session_start();

// Si l'user est connecté
if(isUserConnected())
    redirect('accueil.php');

if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger">
        Erreur dans l'inscription, vérifier les mots de passes ou l'adresse mail est peut être existante...
    </div>
<?php } ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>ETƎ - Inscription</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index2.css"/>
</head>

<body>

<img src="img/logo.png" alt="Logo" class="logo"/>

<section class="d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <h1>INSCRIPTION</h1>
        <form method="POST" action="inscription.php">
        <br/>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" required>
                </div>
                <div class="form-group">
                <input type="email" class="form-control" id="email" placeholder="Adresse e-mail" name="email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="mdp" placeholder="Mot de passe" name="mdp" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="mdpVerif" placeholder="Confirmer le mot de passe" name="mdpVerif" required>
                </div>

                <div class="ligne"></div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <h2>Choisissez votre couleur...</h2>
                    <label>
                        <input type="radio" name="couleur" value="1" checked>
                        <div  class="btn btn-secondary bt1" onclick="changerBg(1)"></div>
                    </label>
                    <label>
                        <input type="radio" name="couleur" value="2">
                        <div  class="btn btn-secondary bt2" onclick="changerBg(2)"></div>
                    </label><label>
                        <input type="radio" name="couleur" value="3">
                        <div  class="btn btn-secondary bt3" onclick="changerBg(3)"></div>
                    </label>
                    <label>
                        <input type="radio" name="couleur" value="4">
                        <div  class="btn btn-secondary bt4" onclick="changerBg(4)"></div>
                    </label>
                </div>
                <div class="form-group">
                    <h2>Choisissez votre avatar...</h2>
                    <label>
                        <input type="radio" name="avatar" value="1" checked>
                        <img src="avatars/1.jpg" style="width: 110px; height: auto; border-radius: 110px; border: 2px solid white;">
                    </label>
                    <label>
                        <input type="radio" name="avatar" value="2">
                        <img src="avatars/2.jpg" style="width: 110px; height: auto; border-radius: 110px; border: 2px solid white;">
                    </label><label>
                        <input type="radio" name="avatar" value="3">
                        <img src="avatars/3.jpg" style="width: 110px; height: auto; border-radius: 110px; border: 2px solid white;">
                    </label>
                    <label>
                        <input type="radio" name="avatar" value="4">
                        <img src="avatars/4.jpg" style="width: 110px; height: auto; border-radius: 110px; border: 2px solid white;">
                    </label>
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">S'INSCRIRE</button>
        </form>
    </div>
</section>
<script>
    function changerBg(param) {
        if(param === 1) {
            <?php $couleur = 1 ?>
            document.body.style.background = 'linear-gradient(270deg, rgba(254, 225, 64, 0.76) 0%, rgba(250, 112, 154, 0.84) 100%)';
        }if(param === 2) {
            <?php $couleur = 2 ?>
            document.body.style.background = 'linear-gradient(90deg, #FC466B 0%, #3F5EFB 100%)';
        }
        if(param === 3) {
            <?php $couleur = 3 ?>
            document.body.style.background = 'linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%)';
        }
        if(param === 4) {
            <?php $couleur = 4 ?>
            document.body.style.background = 'linear-gradient(90deg, #4b6cb7 0%, #182848 100%)';
        }
    }
</script>

</body>
</html>

<?php
if (!empty($_POST['email']) and !empty($_POST['mdp']) and
    !empty($_POST['mdpVerif']) and !empty($_POST['nom']) and
    !empty($_POST['prenom']) and !empty($_POST['avatar']) and !empty($_POST['couleur'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdpVerif = $_POST['mdpVerif'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $avatar = $_POST['avatar'];
    $couleur = $_POST['couleur'];

    // On vérifie que l'adresse mail est unique
    $reqVerifEmail = getDb()->prepare('SELECT * FROM users WHERE email=?');
    $reqVerifEmail->execute(array($email));
    if ($reqVerifEmail->rowCount() < 1 && $mdp == $mdpVerif) {
        // Inscription du compte
        inscription($email, $mdp, $prenom, $nom, $avatar, $couleur);
        // Les headers ne fonctionnent pas wsh
        redirect("index.php?inscription=true");
    }
    redirect("inscription.php?error=true");
}
?>