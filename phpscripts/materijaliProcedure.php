<?php

if (isset($_POST['submit'])) {
    foreach ($_POST as $k => $v) {
        if ($k === "nazivMaterijala") {
            $nazivMaterijala = $v;
        }
        if ($k === "linkMaterijala") {
            $linkMaterijala = $v;
        }
        if ($k === "tipMaterijala") {
            $tipMaterijala = $v;
        }
    }
    if (isset($nazivMaterijala) && isset($linkMaterijala) && isset($tipMaterijala)) {
        if (!empty($nazivMaterijala) && !empty($linkMaterijala) && !empty($tipMaterijala)) {
            $veza = new Baza();
            $veza->spojiDB();
            $upitRezervacija = "INSERT INTO materijal (vrsta_materijala_vrsta_materijala_id, korisnik_korisnik_id, izlet_izlet_id, naziv_materijala, poveznica_mat) VALUES ('{$tipMaterijala}', {$_SESSION['IDkorisnikINT']}, {$_SESSION['idIZLET']}, '{$nazivMaterijala}', '{$linkMaterijala}')";
            $skriptaRezervacija = header("Location: ./materijaliKorisnika.php");
            $veza->updateDB($upitRezervacija, $skriptaRezervacija);
            $veza->zatvoriDB();
        } else {
            echo "<script>alert('Morate sve ispuniti kako bi dodali novi materijal');</script>";
        }
    }
}
?>

