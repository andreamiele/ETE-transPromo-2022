<?php

// Connect to the database. Returns a PDO object
function getDb() {
    $server = "localhost";
    $username = "arnaudbscp";
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
/*
function inscription($mdp, $email, $nom, $prenom, $adre, $code, $tel, $prom, $valide) {
    // Inscription du compte
    $reqInscriptionCompte = getDb()->prepare('INSERT INTO compte(mdp, email, role) VALUES(?, ?, ?)');
    $reqInscriptionCompte->execute(array($mdp, $email, 1));

    // Inscription de l'élève
    $reqInscriptionEleve = getDb()->prepare('INSERT INTO eleve(nom_eleve, prenom_eleve, adresse_eleve, 
                  adresse_visible_eleve, code_postal_eleve, code_postal_visible_eleve, telephone_eleve, 
                  telephone_visible_eleve, url_photo, genre_eleve, promotion_eleve, id_compte, valide, description_eleve)  
                   VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

    // On recherche l'ID du compte pour le lier à l'élève
    $reqGetId = getDb()->prepare('SELECT * FROM compte WHERE email=?');
    $reqGetId->execute(array($email));
    if ($reqGetId->rowCount() == 1) {
        $id = -1;
        while ($res = $reqGetId->fetch()) {
            $id = $res['ID_COMPTE'];
        }
        $reqInscriptionEleve->execute(array($nom, $prenom, $adre, 0, $code, 0, $tel, 0, 'img/profil.png', '', $prom, $id , $valide, ""));
    }
}*/