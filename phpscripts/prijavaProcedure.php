<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

if (isset($_GET['submit'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "SELECT broj_pokusaja FROM konfiguracija";
    $rezultat = $veza->selectDB($upit);
    $row = $rezultat->fetch_assoc();
    $brojPokusaja = $row['broj_pokusaja'];
    $veza->zatvoriDB();

    $greskaKorimeP = "";
    $greskaLozinkaP = "";
    $poruka = "";
    $brojMogucihPokusaja = (int) $brojPokusaja;

    foreach ($_GET as $k => $v) {
        if (empty($v)) {
            if ($k === "korimeP") {
                $greskaKorimeP = "Korisničko ime nije uneseno!";
            }
            if ($k === "lozinkaP") {
                $greskaLozinkaP = "Lozinka nije unešena!";
            }
        }
    }
    if (empty($greska)) {

        $veza = new Baza();
        $veza->spojiDB();

        $korimeP = $_GET['korimeP'];
        $lozinkaP = $_GET['lozinkaP'];

        $upit = "SELECT * FROM korisnik WHERE korisnicko_ime='{$korimeP}'";

        $rezultat = $veza->selectDB($upit);

        $autenticiran = false;
        while ($red = mysqli_fetch_array($rezultat)) {
            if ($red) {
                $status = $red["status_kor"];
                if (!isset($_SESSION['trenutniKorisnik'])) {
                    $_SESSION['trenutniKorisnik'] = $korimeP;
                    $provjeraLozikne = $red["lozinka"];
                    $tip = $red["tip_korisnika_tip_kor_id"];
                    $email = $red["email"];
                } else {
                    if ($_SESSION['trenutniKorisnik'] !== $korimeP) {
                        unset($_SESSION['trenutniKorisnik']);
                        $_SESSION['trenutniKorisnik'] = $korimeP;
                        unset($_SESSION['brojacUnosa']);
                        $_SESSION['bojacUnosa'] = 0;
                        $provjeraLozikne = $red["lozinka"];
                        $tip = $red["tip_korisnika_tip_kor_id"];
                        $email = $red["email"];
                    } else {
                        $provjeraLozikne = $red["lozinka"];
                        $tip = $red["tip_korisnika_tip_kor_id"];
                        $email = $red["email"];
                    }
                }
            }
        }
        if (!isset($provjeraLozikne)) {
            $greskaKorimeP = "Uneseno krivo korisničko ime!";
            unset($_SESSION['trenutniKorisnik']);
            unset($_SESSION['brojacUnosa']);
            $_SESSION['bojacUnosa'] = 0;
        }
        if (isset($provjeraLozikne)) {
            if ($lozinkaP === $provjeraLozikne) {
                $autenticiran = true;
            } else {
                if (!isset($_SESSION['brojacUnosa'])) {
                    $_SESSION['dodaj'] = false;
                }
                if ($_SESSION['dodaj'] === false) {
                    $_SESSION['brojacUnosa'] = 1;
                    $greskaLozinkaP = "Unesena kriva lozinka!";
                    $_SESSION['dodaj'] = true;
                } else {
                    $_SESSION['brojacUnosa']++;
                }
            }
        }
        if ($autenticiran == true) {
            if ($status === "0") {
                $poruka = "Račun je BLOKIRAN!";
            } else {
                if (isset($_GET['checkboxP'])) {
                    $veza = new Baza();
                    $veza->spojiDB();
                    $upitPomak = "SELECT pomakVremena FROM konfiguracija";
                    $rezultatPomak = $veza->selectDB($upitPomak);
                    $pomakVremenaBaza = $rezultatPomak->fetch_assoc();
                    $pomakVremena = $pomakVremenaBaza['pomakVremena'];
                    $pomakTime = (int) $pomakVremena;
                    $timeShift = $pomakTime * 60 * 60;
                    $timeToShift = time();
                    $virtualnoVrijeme = $timeToShift + $timeShift;
                    $veza->zatvoriDB();
                    setcookie("korimeP", $korimeP, $virtualnoVrijeme + (86400 * 7), '/');
                }
                $poruka = "Uspješna prijava!";
                Sesija::kreirajKorisnika($korimeP, $tip);
                header("Location: ../index.php");
                exit();
            }
        } else {
            if (isset($_SESSION['brojacUnosa'])) {
                if ($_SESSION['brojacUnosa'] >= $brojMogucihPokusaja) {
                    $poruka = "Račun je BLOKIRAN!";
                    $updateUPIT = "UPDATE korisnik SET status_kor = 0 WHERE korisnicko_ime = '{$_SESSION['trenutniKorisnik']}'";
                    $veza->updateDB($updateUPIT);
                    unset($_SESSION['brojacUnosa']);
                    unset($_SESSION['trenutniKorisnik']);
                    $_SESSION['bojacUnosa'] = 0;
                } else {
                    $poruka = "Neuspješna prijava, imate jos " . ($brojMogucihPokusaja - $_SESSION['brojacUnosa']) . " pokušaja do BLOKIRANJA korisničkog računa!";
                }
            }
        }
        $veza->zatvoriDB();
    }
}
?>