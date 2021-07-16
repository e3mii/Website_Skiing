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
            $upitStat = "SELECT skijaliste.naziv_skijalista, COUNT(*) AS 'broj_izleta' FROM izlet INNER JOIN skijaliste ON skijaliste.skijaliste_id = izlet.upravitelj_skijaliste_skijaliste_id GROUP BY skijaliste.naziv_skijalista";
            $rezultatUpitaStat = $veza->selectDB($upitStat);
            $izletiStat = array();
            $izletiStat = $rezultatUpitaStat->fetch_all(MYSQLI_ASSOC);
            $veza->zatvoriDB();
            echo json_encode($izletiStat);
            break;
        case "Unos rezervacije":
            if(isset($_SESSION['idIzl'])){
                $odabraniIzletID = $_SESSION['idIzl'];
            }
            $upitUkupneRez = "SELECT CONCAT(ime_rez,' ',prez_rez) AS ime_prezime, br_rez_mjesta FROM rezervacija WHERE izlet_izlet_id = '{$odabraniIzletID}'";
            $rezultatUpitaUkupRez = $veza->selectDB($upitUkupneRez);
            $ukupneRez = array();
            $ukupneRez = $rezultatUpitaUkupRez->fetch_all(MYSQLI_ASSOC);
            $veza->zatvoriDB();
            echo json_encode($ukupneRez);
            
            break;
        case "Sve rezervacije":
            $upitSveRez = "SELECT rezervacija_id, CONCAT(ime_rez,' ',prez_rez) AS 'ime_prezime', br_rez_mjesta, pristiglo_nakon_brmj FROM rezervacija ORDER BY rezervacija_id";
            $rezultatSveRez = $veza->selectDB($upitSveRez);
            $sveRez = array();
            $sveRez = $rezultatSveRez->fetch_all(MYSQLI_ASSOC);
            $veza->zatvoriDB();
            echo json_encode($sveRez);
            break;
        default:
            break;
    }
}
?>