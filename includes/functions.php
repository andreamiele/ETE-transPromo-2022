<?php

// Connect to the database. Returns a PDO object
function getDb() {
    $server = "localhost";
    $username = "arnaud";
    $password = "azerty";
    $db = "ete";

    return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

function redirect($url) {
    header("Location: $url");
}

function isUserConnected() {
    return isset($_SESSION['id']);
}

function inscription($email, $mdp, $prenom, $nom, $avatar, $couleur) {
    $reqInscriptionCompte = getDb()->prepare('INSERT INTO users(email, password, prenom, nom, avatar, couleur, derniereConnexion, nbJours, avancementJeu, score, DonneesJeuMatrice, DonneesJeuCroises) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $reqInscriptionCompte->execute(array($email, $mdp, $prenom, $nom, $avatar, $couleur, date('Y-m-d H:i:s'), 1, 0, 0, NULL, NULL));
}

function inscrireDonnees($nb) {
    $jeu = 'DonneesJeuCroises';
    if($nb == 1)
        $jeu = 'DonneesJeuMatrice';
    // Vérifier qu'aucune données n'est rentrée aujourd'hui avant de mettre
    $valide = false;
    $req = getDb()->prepare('Select * FROM users where id= ' . $_SESSION['id']);
    $req->execute();
    if ($req->rowCount() == 1) {
        while ($res = $req->fetch()) {
            if($res[$jeu] == NULL)
                $valide = true;
            else {
                $tab = json_decode($res[$jeu]);
                $_SESSION[$jeu] = $res[$jeu];
                if($tab[count($tab)-2] == date('Y-m-d'))
                    $valide = false;
                else
                    $valide = true;
            }
        }
    }
    if($valide == true) {
        $_SESSION['avancementJeu'] += 1;
        $req = getDb()->prepare('UPDATE users set score = ?, avancementJeu = ?, DonneesJeuCroises = ? where id= ' . $_SESSION['id']);
        $nouveauScore = $_SESSION['score'] + $_GET['score'];
        $_SESSION['score'] = $nouveauScore;
        $ancienTableau = json_decode($_SESSION[$jeu], true);
        $donnees = array(date('Y-m-d'), $_GET['temps']);
        if($ancienTableau == null)
            $_SESSION[$jeu] = json_encode($donnees);
        else
            $_SESSION[$jeu] = json_encode(array_merge($ancienTableau, $donnees));
        $req->execute(array($nouveauScore, $_SESSION['avancementJeu'],$_SESSION[$jeu]));
        echo '<script type="text/JavaScript"> 
    window.location.replace("http://localhost:8888/accueil.php");
     </script>';
    }
}