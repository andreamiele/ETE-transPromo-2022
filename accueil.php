<?php
require_once "includes/functions.php";
session_start();

echo 'Coucou ' . $_SESSION['prenom'] . ' !';