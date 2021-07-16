<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

if (isset($_POST["submit"])) {
    $provjeraUnosa = false;
    $captcha;
    $captchaGreska = "";
    $provjeraCaptcha = "false";
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
    }
    if (!$captcha) {
        $captchaGreska = "Molimo Vas da ispunite CAPTCHU!";
    }
    $secretKey = "6LdpEwcbAAAAAMObrGMwtG5-IwwjqmlzsOncREBS";
    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);
    // should return JSON with success as true
    if ($responseKeys["success"]) {
        $provjeraCaptcha = "true";
    }

    if ($_SESSION['provjeraKor'] === true && $_SESSION['provjeraEmail'] === true) {
        $provjeraUnosa = true;
    } else if ($_SESSION['provjeraKor'] === false && $_SESSION['provjeraEmail'] === true) {
        echo "<script>alert('Korisnicko ime vec postoji, molimo promjenite unos!')</script>";
    } else if ($_SESSION['provjeraKor'] === true && $_SESSION['provjeraEmail'] === false) {
        echo "<script>alert('Email vec postoji, molimo promjenite unos!')</script>";
    } else if ($_SESSION['provjeraKor'] === false && $_SESSION['provjeraEmail'] === false) {
        echo "<script>alert('Korisnicko ime i email vec postoje, molimo promjenite unos!')</script>";
    }


    if (empty($captchaGreska) && $provjeraUnosa === true) {
        foreach ($_POST as $k => $v) {
            if ($k === "imeR") {
                $imeR = $v;
            }
            if ($k === "prezimeR") {
                $prezimeR = $v;
            }
            if ($k === "korimeR") {
                $korimeR = $v;
            }
            if ($k === "emailR") {
                $emailR = $v;
            }
            if ($k === "lozinkaR") {
                $lozinkaR = $v;

                $hashLozinkaR = hash('sha256', $v);

                function createSolR() {
                    $textR = md5(uniqid(rand(), true));
                    return substr($textR, 0, 3);
                }

                $solR = createSolR();
                $hashLozinkaSolR = hash('sha256', $solR . $hashLozinkaR);
            }
        }

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
        $vrijemeR = date("Y-m-d H:i:s", $virtualnoVrijeme);
        $upitRegistracija = "INSERT INTO korisnik (tip_korisnika_tip_kor_id, ime_kor, prez_kor, korisnicko_ime, lozinka, lozinkaSHA256, email, uvjeti, status_kor, datum_vrijeme) VALUES (3, '{$imeR}', '{$prezimeR}', '{$korimeR}', '{$lozinkaR}', '{$hashLozinkaSolR}', '{$emailR}', null, 1, '{$vrijemeR}')";
        $skriptaRegistracija = header("Location: ../obrasci/prijava.php");
        $veza->updateDB($upitRegistracija, $skriptaRegistracija);
        $veza->zatvoriDB();
        
    }
}
?>