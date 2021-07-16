<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

$idIzl = 1;
$brMAXRezINT = 0;
$brTRENRezINT = 0;
$IDkorisnikINT = 1;
$odobrenje = true;

if (isset($_GET['idIzl'])) {
    $_SESSION['idIzl'] = $_GET['idIzl'];
}

if (isset($_SESSION['idIzl'])) {
    $idIzl = $_SESSION['idIzl'];
    $veza = new Baza();
    $veza->spojiDB();

    $upitIDkorisnik = "SELECT korisnik_id FROM korisnik WHERE korisnicko_ime = '{$_SESSION['korisnik']}'";
    $rezultatUpitaID = $veza->selectDB($upitIDkorisnik);
    $IDkorisnikBAZA = $rezultatUpitaID->fetch_assoc();
    $IDkorisnikSTRING = $IDkorisnikBAZA['korisnik_id'];

    $upitMAXbr = "SELECT max_br_kor FROM izlet WHERE izlet_id = '{$idIzl}'";
    $rezultatUpitaMAX = $veza->selectDB($upitMAXbr);
    $brMAXRezBAZA = $rezultatUpitaMAX->fetch_assoc();
    $brMAXRezSTRING = $brMAXRezBAZA['max_br_kor'];

    $upitTRENbr = "SELECT SUM(br_rez_mjesta) AS ukupno_rezerviranih FROM rezervacija WHERE izlet_izlet_id = '{$idIzl}'";
    $rezultatUpitaTREN = $veza->selectDB($upitTRENbr);
    $brTRENRezBAZA = $rezultatUpitaTREN->fetch_assoc();
    $brTRENRezSTRING = $brTRENRezBAZA['ukupno_rezerviranih'];

    $IDkorisnikINT = (int) $IDkorisnikSTRING;
    $brMAXRezINT = (int) $brMAXRezSTRING;
    $brTRENRezINT = (int) $brTRENRezSTRING;

    $upitPostojanjaRez = "SELECT rezervacija_id, ime_rez, prez_rez, br_rez_mjesta FROM rezervacija WHERE korisnik_korisnik_id = '{$IDkorisnikINT}' && izlet_izlet_id = '{$idIzl}'";
    $rezultatPostojanjaRez = $veza->selectDB($upitPostojanjaRez);
    $postojanjeBAZA = $rezultatPostojanjaRez->fetch_assoc();
    if ($postojanjeBAZA !== null) {
        $rezervacija_id = $postojanjeBAZA['rezervacija_id'];
        $ime_rez = $postojanjeBAZA['ime_rez'];
        $prez_rez = $postojanjeBAZA['prez_rez'];
        $br_rez_mjesta = $postojanjeBAZA['br_rez_mjesta'];
    }

    $veza->zatvoriDB();
}

if (isset($_POST['obrisi'])) {

    $veza = new Baza();
    $veza->spojiDB();
    $upitRezervacija = "DELETE FROM rezervacija WHERE rezervacija_id = {$rezervacija_id}";
    $skriptaRezervacija = header("Location: ../index.php");
    $veza->updateDB($upitRezervacija, $skriptaRezervacija);
    $veza->zatvoriDB();
}

if (isset($_POST["submit"])) {
    if (isset($rezervacija_id) && isset($ime_rez) && isset($prez_rez) && isset($br_rez_mjesta)) {
        foreach ($_POST as $k => $v) {
            if ($k === "imeRez") {
                if (!empty($v)) {
                    $imeRez = $v;
                }
            }
            if ($k === "prezimeRez") {
                if (!empty($v)) {
                    $prezimeRez = $v;
                }
            }
            if ($k === "brMjestaRez") {
                if (!empty($v)) {
                    $brMjestaRez = $v;
                    if ($brMjestaRez > $brMAXRezINT) {
                        $odobrenje = false;
                    }
                }
            }
        }

        $veza = new Baza();
        $veza->spojiDB();

        if ($odobrenje === false) {
            echo "<script>alert('Ne smijete odabrati više od maksimalnog (" . $brMAXRezINT . ") broj mjesta izleta!');</script>";
        } else if(($brMjestaRez + $brTRENRezINT) < $brMAXRezINT) {
            $upitRezervacija = "UPDATE rezervacija SET ime_rez = '{$imeRez}', prez_rez = '{$prezimeRez}', br_rez_mjesta = {$brMjestaRez}, pristiglo_nakon_brmj = 0 WHERE rezervacija_id = {$rezervacija_id}";
            $skriptaRezervacija = header("Location: ../index.php");
            $veza->updateDB($upitRezervacija, $skriptaRezervacija);
            $veza->zatvoriDB();
        } else if (($brMjestaRez + $brTRENRezINT) > $brMAXRezINT) {
            $upitRezervacija = "UPDATE rezervacija SET ime_rez = '{$imeRez}', prez_rez = '{$prezimeRez}', br_rez_mjesta = {$brMjestaRez}, pristiglo_nakon_brmj = 1 WHERE rezervacija_id = {$rezervacija_id}";
            $skriptaRezervacija = header("Location: ../index.php");
            $veza->updateDB($upitRezervacija, $skriptaRezervacija);
            $veza->zatvoriDB();
        }
        $odobrenje = true;
    } else {
        foreach ($_POST as $k => $v) {
            if ($k === "imeRez") {
                if (!empty($v)) {
                    $imeRez = $v;
                }
            }
            if ($k === "prezimeRez") {
                if (!empty($v)) {
                    $prezimeRez = $v;
                }
            }
            if ($k === "brMjestaRez") {
                if (!empty($v)) {
                    $brMjestaRez = $v;
                    if ($brMjestaRez > $brMAXRezINT) {
                        $odobrenje = false;
                    }
                }
            }
        }

        $veza = new Baza();
        $veza->spojiDB();

        if ($odobrenje === false) {
            echo "<script>alert('Ne smijete odabrati više od maksimalnog (" . $brMAXRezINT . ") broj mjesta izleta!');</script>";
        } else if (($brMjestaRez + $brTRENRezINT) < $brMAXRezINT) {
            $upitRezervacija = "INSERT INTO rezervacija (korisnik_korisnik_id, izlet_izlet_id, status_rez, ime_rez, prez_rez, br_rez_mjesta, pristiglo_nakon_brmj) VALUES ({$IDkorisnikINT}, {$idIzl}, 0, '{$imeRez}', '{$prezimeRez}', {$brMjestaRez}, 0)";
            $skriptaRezervacija = header("Location: ../index.php");
            $veza->updateDB($upitRezervacija, $skriptaRezervacija);
            $veza->zatvoriDB();
        } else if (($brMjestaRez + $brTRENRezINT) > $brMAXRezINT) {
            $upitRezervacija = "INSERT INTO rezervacija (korisnik_korisnik_id, izlet_izlet_id, status_rez, ime_rez, prez_rez, br_rez_mjesta, pristiglo_nakon_brmj) VALUES ({$IDkorisnikINT}, {$idIzl}, 0, '{$imeRez}', '{$prezimeRez}', {$brMjestaRez}, 1)";
            $skriptaRezervacija = header("Location: ../index.php");
            $veza->updateDB($upitRezervacija, $skriptaRezervacija);
            $veza->zatvoriDB();
        }
        $odobrenje = true;
    }
}
?>