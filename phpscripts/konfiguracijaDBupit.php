<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

$veza = new Baza();
$veza->spojiDB();


$upitRedci = "SELECT broj_redaka FROM konfiguracija";

$rezultatRedci = $veza->selectDB($upitRedci);

$redRedci = $rezultatRedci->fetch_assoc();

$brojRedakaS = $redRedci['broj_redaka'];

$brRedakaS = (int) $brojRedakaS;

$veza->zatvoriDB();

echo $brRedakaS;
?>