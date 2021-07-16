<?php

$putanja = dirname($_SERVER['REQUEST_URI'],2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

Sesija::kreirajKorisnika("eradotovic", "1");

if(isset($_SESSION["uloga"])){
    header("Location: ../index.php");
    exit();
}

?>