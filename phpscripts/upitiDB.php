<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

$stranica = $_POST['stranica'];

if (isset($stranica)) {
    $veza = new Baza();
    $veza->spojiDB();
    switch ($stranica) {
        case "Početna stranica":

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['sortIzlet'])) {

                    if ($_POST['sortIzlet'] === "true") {
                        $upit = "SELECT izlet.izlet_id, izlet.naziv_izleta, skijaliste.naziv_skijalista, izlet.opis_izleta FROM `izlet` INNER JOIN `skijaliste` ON skijaliste.skijaliste_id = izlet.upravitelj_skijaliste_skijaliste_id WHERE status_izleta = 1 ORDER BY izlet.naziv_izleta";
                        $rezultatUpita = $veza->selectDB($upit);
                        $izleti = array();
                        $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                        $veza->zatvoriDB();
                        echo json_encode($izleti);
                    } else if ($_POST['sortSkijaliste'] === "true") {
                        $upit = "SELECT izlet.izlet_id, izlet.naziv_izleta, skijaliste.naziv_skijalista, izlet.opis_izleta FROM `izlet` INNER JOIN `skijaliste` ON skijaliste.skijaliste_id = izlet.upravitelj_skijaliste_skijaliste_id WHERE status_izleta = 1 ORDER BY skijaliste.naziv_skijalista";
                        $rezultatUpita = $veza->selectDB($upit);
                        $izleti = array();
                        $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                        $veza->zatvoriDB();
                        echo json_encode($izleti);
                    } else {
                        $upit = "SELECT izlet.izlet_id, izlet.naziv_izleta, skijaliste.naziv_skijalista, izlet.opis_izleta FROM `izlet` INNER JOIN `skijaliste` ON skijaliste.skijaliste_id = izlet.upravitelj_skijaliste_skijaliste_id WHERE status_izleta = 1 ORDER BY skijaliste.naziv_skijalista";
                        $rezultatUpita = $veza->selectDB($upit);
                        $izleti = array();
                        $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                        $veza->zatvoriDB();
                        echo json_encode($izleti);
                    }
                }
            }

            break;
        case "Stranica registracije":
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['korimeR'])) {
                    $provjeraKor = false;
                    $korimeR = $_POST['korimeR'];
                    $upit = "SELECT korisnicko_ime FROM `korisnik` WHERE korisnicko_ime = '{$korimeR}'";
                    $rezultatKorime = $veza->selectDB($upit);
                    $provKorime = mysqli_num_rows($rezultatKorime);
                    $veza->zatvoriDB();
                    if ($provKorime === 0) {
                        $provjeraKor = true;
                        $_SESSION['provjeraKor'] = $provjeraKor;
                    } else {
                        $provjeraKor = false;
                        $_SESSION['provjeraKor'] = $provjeraKor;
                    }
                }
                if (isset($_POST['emailR'])) {
                    $provjeraEmail = false;
                    $emailR = $_POST['emailR'];
                    $upit = "SELECT email FROM `korisnik` WHERE email = '{$emailR}'";
                    $rezultatEmail = $veza->selectDB($upit);
                    $provEmail = mysqli_num_rows($rezultatEmail);
                    $veza->zatvoriDB();
                    if ($provEmail === 0) {
                        $provjeraEmail = true;
                        $_SESSION['provjeraEmail'] = $provjeraEmail;
                    } else {
                        $provjeraEmail = false;
                        $_SESSION['provjeraEmail'] = $provjeraEmail;
                    }
                }
            }
            break;
        case "Administracija":
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['sortPrezime'])) {
                    if ($_POST['sortPrezime'] === "true") {
                        $upit = "SELECT korisnik.korisnik_id, CONCAT(korisnik.prez_kor,' ',korisnik.ime_kor) as ime_prezime, tip_korisnika.naziv_tipa_kor as uloga, korisnik.status_kor as status FROM korisnik INNER JOIN tip_korisnika ON tip_korisnika.tip_kor_id = korisnik.tip_korisnika_tip_kor_id ORDER BY korisnik.prez_kor";
                        $rezultatUpita = $veza->selectDB($upit);
                        $izleti = array();
                        $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                        $veza->zatvoriDB();
                        echo json_encode($izleti);
                    } else if ($_POST['sortStatus'] === "true") {
                        $upit = "SELECT korisnik.korisnik_id, CONCAT(korisnik.prez_kor,' ',korisnik.ime_kor) as ime_prezime, tip_korisnika.naziv_tipa_kor as uloga, korisnik.status_kor as status FROM korisnik INNER JOIN tip_korisnika ON tip_korisnika.tip_kor_id = korisnik.tip_korisnika_tip_kor_id ORDER BY korisnik.status_kor";
                        $rezultatUpita = $veza->selectDB($upit);
                        $izleti = array();
                        $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                        $veza->zatvoriDB();
                        echo json_encode($izleti);
                    } else {
                        $upit = "SELECT korisnik.korisnik_id, CONCAT(korisnik.prez_kor,' ',korisnik.ime_kor) as ime_prezime, tip_korisnika.naziv_tipa_kor as uloga, korisnik.status_kor as status FROM korisnik INNER JOIN tip_korisnika ON tip_korisnika.tip_kor_id = korisnik.tip_korisnika_tip_kor_id";
                        $rezultatUpita = $veza->selectDB($upit);
                        $izleti = array();
                        $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                        $veza->zatvoriDB();
                        echo json_encode($izleti);
                    }
                }
            }

            if (isset($_POST['promjenaID']) && isset($_POST['status'])) {
                if ($_POST['status'] === "0") {
                    $upitStatus = "UPDATE korisnik SET status_kor = 1 WHERE korisnik_id = '{$_POST['promjenaID']}'";
                    $promjenaStatusa = $veza->updateDB($upitStatus);
                    $veza->zatvoriDB();
                } else if ($_POST['status'] === "1") {
                    $upitStatus = "UPDATE korisnik SET status_kor = 0 WHERE korisnik_id = '{$_POST['promjenaID']}'";
                    $promjenaStatusa = $veza->updateDB($upitStatus);
                    $veza->zatvoriDB();
                }
            }

            break;
        case "Svi korisnici";

            if ($_POST['sortKorime'] === "true") {
                $upit = "SELECT CONCAT(ime_kor,' ',prez_kor) AS 'ime_prezime', korisnicko_ime, lozinka, email FROM korisnik ORDER BY korisnicko_ime";
                $rezultatUpita = $veza->selectDB($upit);
                $izleti = array();
                $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                $veza->zatvoriDB();
                echo json_encode($izleti);
            } else if ($_POST['sortEmail'] === "true") {
                $upit = "SELECT CONCAT(ime_kor,' ',prez_kor) AS 'ime_prezime', korisnicko_ime, lozinka, email FROM korisnik ORDER BY email";
                $rezultatUpita = $veza->selectDB($upit);
                $izleti = array();
                $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                $veza->zatvoriDB();
                echo json_encode($izleti);
            } else {
                $upit = "SELECT CONCAT(ime_kor,' ',prez_kor) AS 'ime_prezime', korisnicko_ime, lozinka, email FROM korisnik ORDER BY korisnik.prez_kor";
                $rezultatUpita = $veza->selectDB($upit);
                $izleti = array();
                $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                $veza->zatvoriDB();
                echo json_encode($izleti);
            }
            
            break;
        case "Matrijali korisnika":
            if (isset($_SESSION['idIZLET'])) {
                $upit = "SELECT vrsta_materijala.naziv_vrste_mat , materijal.poveznica_mat, materijal.naziv_materijala FROM materijal INNER JOIN vrsta_materijala ON vrsta_materijala.vrsta_materijala_id = materijal.vrsta_materijala_vrsta_materijala_id WHERE materijal.izlet_izlet_id = '{$_SESSION['idIZLET']}'";
                $rezultatUpita = $veza->selectDB($upit);
                $izleti = array();
                $izleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
                $veza->zatvoriDB();
                echo json_encode($izleti);
            }
            break;
        case "Rezervacije":
            $upitIzleta = "SELECT izlet.izlet_id, izlet.naziv_izleta, skijaliste.naziv_skijalista, izlet.opis_izleta FROM izlet INNER JOIN skijaliste ON skijaliste.skijaliste_id = izlet.upravitelj_skijaliste_skijaliste_id WHERE izlet.status_izleta = 0";
            $rezultatUpita = $veza->selectDB($upitIzleta);
            $neOrgizleti = array();
            $neOrgizleti = $rezultatUpita->fetch_all(MYSQLI_ASSOC);
            $veza->zatvoriDB();
            echo json_encode($neOrgizleti);
            break;
        default:
            $veza->zatvoriDB();
            break;
    }
}
?>
