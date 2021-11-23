
<?php
require_once "includes/functions.php";
session_start();

// Si l'user n'est pas connecté
if(!isUserConnected())
    redirect('index.php');


if (!empty($_POST['delete'])){
    $req = getDb()->prepare('DELETE FROM users where id=' . $_SESSION['id']);
    $req->execute();
    echo '<script type="text/JavaScript"> 
    window.location.replace("deconnexion.php");
     </script>';
}
