<?php

// Connect to the database. Returns a PDO object
function getDb() {
    $server = "localhost";
    $username = "root";
    $password = "";
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
    $reqInscriptionCompte = getDb()->prepare('INSERT INTO users(email, password, prenom, nom, avatar, couleur, derniereConnexion, avancementJeu, score, DonneesJeuMatrice, DonneesJeuCroises) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $reqInscriptionCompte->execute(array($email, $mdp, $prenom, $nom, $avatar, $couleur, date('Y-m-d H:i:s'), NULL, 0, NULL, NULL));
}