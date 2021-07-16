<?php

$putanja = dirname($_SERVER['REQUEST_URI'],2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

if(isset($_SESSION["uloga"])){
    header("Location: ../obrasci/prijava.php");
    Sesija::obrisiSesiju();
    exit();
}

?>
