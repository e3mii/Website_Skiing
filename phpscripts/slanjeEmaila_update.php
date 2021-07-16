<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

$veza = new Baza();
$veza->spojiDB();

$emailZaPromjenu = $_POST['emailZaPromjenu'];
$lozinka = $_POST['lozinka'];

$hashLozinka = hash('sha256', $lozinka);
function createSol(){
    $text = md5(uniqid(rand(), true));
    return substr($text,0,3);
}
$sol = createSol();
$hashLozinkaSol = hash('sha256', $sol.$hashLozinka);
$upitPromjenaLozinke = "UPDATE korisnik SET lozinka = '{$lozinka}', lozinkaSHA256 = '{$hashLozinkaSol}' WHERE email = '{$emailZaPromjenu}'";
$promjenaLozinka = $veza->updateDB($upitPromjenaLozinke);

$veza->zatvoriDB();

$mail_to = $emailZaPromjenu;
$mail_from = "From: SKIplaner@skiplaner.com";
$mail_subject = "SKIplaner-promjena lozinke";
$mail_body = "Vaša nova generirana lozinka je: " . $lozinka;
mail($mail_to, $mail_subject, $mail_body, $mail_from);

?>