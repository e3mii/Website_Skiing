<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
include 'zaglavlje.php';

$brRedaka = 0;
$brPrijava = 0;

if (isset($_POST['submit'])) {
    $veza = new Baza();
    $veza->spojiDB();
    foreach ($_POST as $k => $v) {
        if ($k === "brRedaka") {
            if (!empty($v)) {
                $brRedaka = (int) $v;
            }
        }
        if ($k === "brPrijava") {
            if (!empty($v)) {
                $brPrijava = (int) $v;
            }
        }
    }
    if ($brRedaka === 0 && $brPrijava === 0) {
        echo'<script>alert("Konfiguracije nisu promjenjene!")</script>';
        $veza->zatvoriDB();
    } else if ($brRedaka !== 0 && $brPrijava === 0) {
        $upitStatus = "UPDATE konfiguracija SET broj_redaka = {$brRedaka}";
        $promjenaStatusa = $veza->updateDB($upitStatus);
        $veza->zatvoriDB();
        echo'<script>alert("Konfiguracije spremljene!")</script>';
    } else if ($brRedaka === 0 && $brPrijava !== 0) {
        $upitStatus = "UPDATE konfiguracija SET broj_pokusaja = {$brPrijava}";
        $promjenaStatusa = $veza->updateDB($upitStatus);
        $veza->zatvoriDB();
        echo'<script>alert("Konfiguracije spremljene!")</script>';
    } else if ($brRedaka !== 0 && $brPrijava !== 0) {
        $upitStatus = "UPDATE konfiguracija SET broj_redaka = {$brRedaka}, broj_pokusaja = {$brPrijava}";
        $promjenaStatusa = $veza->updateDB($upitStatus);
        $veza->zatvoriDB();
        echo'<script>alert("Konfiguracije spremljene!")</script>';
    }
}

if (isset($_POST['postaviVrijemeButton'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $url = "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json";
    if (!($fp = fopen($url, 'r'))) {
        echo "Nije moguće otvoriti url: " . $url;
        exit;
    }
    $string = fread($fp, 10000);
    $json = json_decode($string, false);
    $sati = $json->WebDiP->vrijeme->pomak->brojSati;
    $sati = (is_numeric($sati)) ? $sati : 0;
    fclose($fp);
    //$promjena_sati = (int) $sati;
    $upitVrijeme = "UPDATE konfiguracija SET pomakVremena = {$sati}";
    $promjenaVremena = $veza->updateDB($upitVrijeme);
    echo'<script>alert("Promjenili ste virtualno vrijeme!")</script>';
    $veza->zatvoriDB();
}
?>
