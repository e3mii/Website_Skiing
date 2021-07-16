<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';

$odobreno = false;
$email = $_POST['emailZaPromjenu'];

$veza = new Baza();
$veza->spojiDB();

$upitPretrageEmail = "SELECT * FROM korisnik WHERE email = '$email'";

$pretragaEmail = $veza->selectDB($upitPretrageEmail);

while ($row = mysqli_fetch_array($pretragaEmail)) {
    if($row['email'] === $email){
        $odobreno = true;
    }
}

$veza->zatvoriDB();
echo $odobreno;
?>