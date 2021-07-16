var naziv_stranice = document.title;
switch (naziv_stranice) {
    case "Stranica prijave":
        $(document).ready(function () {
            $("#zaboravljenaLozinka").click(function () {
                var emailZaPromjenu = prompt("Unesite email korisničkog računa za koji želite promjeniti lozinku:", "TEST");
                $.ajax({
                    url: '../phpscripts/provjeraEmaila.php',
                    method: 'POST',
                    data: {emailZaPromjenu: emailZaPromjenu},
                    success: function (data) {
                        if (data == true) {
                            var znakovi = "qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM1234567890";
                            var lozinka = "";
                            var RegExpLozinka = new RegExp((/^(?!.*(.)\1{3})((?=.*[\d])(?=.*[A-Za-z])|(?=.*[^\w\d\s])(?=.*[A-Za-z])).{8,10}$/));
                            var provjeraNoveLozinke = RegExpLozinka.test(lozinka);
                            while (!provjeraNoveLozinke) {
                                for (var i = 0; i < 10; i++) {
                                    var randBroj = Math.floor(Math.random() * znakovi.length);
                                    lozinka += znakovi[randBroj];
                                }
                                var provjeraNoveLozinke = RegExpLozinka.test(lozinka);
                            }
                            $.ajax({
                                url: '../phpscripts/slanjeEmaila_update.php',
                                method: 'POST',
                                data: {emailZaPromjenu: emailZaPromjenu, lozinka: lozinka},
                                success: function () {
                                    confirm("Na " + emailZaPromjenu + " Vam je stigla nova lozinka!");
                                }
                            });
                        } else {
                            alert("Lozinka nije promjenjena!");
                            location.reload();
                        }
                    }
                });
            });
        });
        break;
    case "Početna stranica":
        $(document).ready(function () {

            function getFromBase() {
                var brojElemenataBaza = $.ajax({
                    url: "./phpscripts/konfiguracijaDBupit.php",
                    method: "POST",
                    async: false,
                    success: function (data) {}

                }).responseText;

                return brojElemenataBaza;
            }

            var brojElemenata = parseInt(getFromBase());
            var zadnjiElement = 0;
            var pocetniElement = 0;
            var trenutnaStranica = 0;
            var odabir = "";
            var sortIzlet = "false";
            var sortSkijaliste = "false";

            $(document).on("click", "#SortiranjeButton", function () {
                if (document.getElementById('nazivIzlet').checked) {
                    sortIzlet = "true";
                    sortSkijaliste = "false";
                    podaci_load();
                } else if (document.getElementById('nazivSkijaliste').checked) {
                    sortIzlet = "false";
                    sortSkijaliste = "true";
                    podaci_load();
                }
            });

            function podaci_load(odabir) {
                $.ajax({
                    url: "./phpscripts/upitiDB.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {stranica: "Početna stranica", sortIzlet: sortIzlet, sortSkijaliste: sortSkijaliste},
                    success: function (data) {
                        var unos = "";

                        var tablica = document.getElementById('izleti_pocetna');
                        tablica.innerHTML = "<table id='izletiTablica' border='1'>" +
                                "<thead><tr style='text-align:center'>" +
                                "<th width='25%'>Naziv izleta</th>" +
                                "<th width='25%'>Naziv skijalista</th>" +
                                "<th width='40%'>Opis izleta</th>" +
                                "<th width='5%'>DETALJI</th>" +
                                "</tr>" +
                                "</thead>" +
                                "<tbody>" +
                                "</tbody>" +
                                "</table>";
                        var bodi = $('#izletiTablica tbody');
                        var brojStranica = Math.ceil(data.length / brojElemenata);
                        pocetniElement = brojElemenata * trenutnaStranica;
                        zadnjiElement = pocetniElement + brojElemenata;
                        let paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);

                        if (odabir === "1") {
                            trenutnaStranica = 0;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "2") {
                            if (trenutnaStranica > 0)
                                trenutnaStranica--;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "3") {
                            if (trenutnaStranica < brojStranica - 1)
                                trenutnaStranica++;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "4") {
                            trenutnaStranica = brojStranica - 1;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        for (var i = 0; i < paginatedItem.length; i++) {
                            unos += "<tr style='text-align:center'>" +
                                    "<td>" + paginatedItem[i][1].naziv_izleta + "</td>" +
                                    "<td>" + paginatedItem[i][1].naziv_skijalista + "</td>" +
                                    "<td style='text-align:left'>" + paginatedItem[i][1].opis_izleta + "</td>" +
                                    "<td><a style='text-decoration:none; color:black' href='./materijaliKorisnika.php?idIZLET=" + paginatedItem[i][1].izlet_id + "'>Detalji</a></td>" +
                                    "</tr>";
                        }
                        bodi.html(unos);

                        /*//MAKIVANJE DUPLIKATA ZA PRETRAGU I ISPIS OPCIJA
                         var izbornik = $('#pretragaSkijalista'); 
                         for (var i = 0; i < Object.entries(data).length; i++) {
                         poljeSkijalista.push(Object.entries(data)[i][1].naziv_skijalista);
                         }
                         let uniqueSki = [...new Set(poljeSkijalista)];
                         for (var i = 0; i < uniqueSki.length; i++) {
                         opcije += "<option value=" + uniqueSki[i] + ">" + uniqueSki[i] + "</option>";
                         }
                         izbornik.html(opcije);*/
                    }
                });
            }

            $(document).on("click", ".stranica_link", function () {
                odabir = $(this).attr("id");
                podaci_load(odabir);
            });
            podaci_load();

            function prikazStatistike() {
                var statistika = document.getElementById('statIzlet');
                statistika.innerHTML = "";
                $.ajax({
                    url: "./phpscripts/upitDBbezstranicenja.php",
                    method: "POST",
                    data: {stranica: "Početna stranica"},
                    success: function (data) {
                        var unoStat = "";
                        const statPolje = JSON.parse(data);
                        statistika.innerHTML = "<table id='statTablica' style='text-align:center' border='1'>" +
                                "<thead><tr>" +
                                "<th width='50%'>Naziv skijališta</th>" +
                                "<th width='50%'>Broj izleta</th>" +
                                "</tr>" +
                                "</thead>" +
                                "<tbody>" +
                                "</tbody>" +
                                "</table>";
                        var statBodi = $('#statTablica tbody');
                        for (var i = 0; i < statPolje.length; i++) {
                            unoStat += "<tr>" +
                                    "<td>" + statPolje[i].naziv_skijalista + "</td>" +
                                    "<td>" + statPolje[i].broj_izleta + "</td>" +
                                    "</tr>";
                        }
                        statBodi.html(unoStat);
                    }
                });
            }
            prikazStatistike();
        });
        break;

    case "Stranica registracije":
        $(document).ready(function () {
            document.getElementById('registracijaButton').disabled = true;
            var korime = false;
            var email = false;
            var lozinka = false;
            var potvrda = false;
            var ime = false;
            var prezime = false;

            $('#korimeR').keyup(function () {
                $.ajax({
                    url: "../phpscripts/upitiDB.php",
                    method: "POST",
                    data: {stranica: "Stranica registracije", korimeR: this.value},
                    success: function () {}
                });
                var RegExpKorime = new RegExp((/^(?!.*(.)\1{2})(?!.*[\d])(?!.*[A-Z])(?=.*[a-z]).{4,20}$/));
                var Rkorime = document.getElementById('korimeR').value;
                var provjeraKorime = RegExpKorime.test(Rkorime);
                if (!provjeraKorime) {
                    $("#korimeR").attr("style", "border: 3px solid red");
                    korime = false;
                } else {
                    $("#korimeR").attr("style", "none");
                    korime = true;
                }
            });

            $('#emailR').keyup(function () {
                $.ajax({
                    url: "../phpscripts/upitiDB.php",
                    method: "POST",
                    data: {stranica: "Stranica registracije", emailR: this.value},
                    success: function () {}
                });
                var RegExpEmail = new RegExp((/^(?![\d])[\w\d]+@[\w]{2,15}[.][\w]{2,4}$/));
                var Remail = document.getElementById('emailR').value;
                var provjeraEmail = RegExpEmail.test(Remail);
                if (!provjeraEmail) {
                    $("#emailR").attr("style", "border: 3px solid red");
                    email = false;
                } else {
                    $("#emailR").attr("style", "none");
                    email = true;
                }
            });

            $('#lozinkaR').keyup(function () {
                var RegExpLozinka = new RegExp((/^(?!.*(.)\1{3})((?=.*[\d])(?=.*[A-Za-z])|(?=.*[^\w\d\s])(?=.*[A-Za-z])).{8,20}$/));
                var Rlozinka = document.getElementById('lozinkaR').value;
                var Rpotvrda = document.getElementById('lozinkapotvrda').value;
                var provjeraLozinke = RegExpLozinka.test(Rlozinka);
                if (!provjeraLozinke) {
                    $("#lozinkaR").attr("style", "border: 3px solid red");
                    lozinka = false;
                } else {
                    $("#lozinkaR").attr("style", "none");
                    lozinka = true;
                }
                if (Rlozinka === Rpotvrda) {
                    $("#lozinkapotvrda").attr("style", "none");
                    document.getElementById('potvrdaRINFO').innerHTML = "";
                    potvrda = true;
                } else {
                    $("#lozinkapotvrda").attr("style", "border: 3px solid red");
                    document.getElementById('potvrdaRINFO').innerHTML = "<span>Potvrda nije jednaka kao lozinka!</span><br>";
                    potvrda = false;
                }
            });

            $('#lozinkapotvrda').keyup(function () {
                var Rlozinka = document.getElementById('lozinkaR').value;
                var Rpotvrda = this.value;
                if (Rlozinka === Rpotvrda) {
                    $("#lozinkapotvrda").attr("style", "none");
                    document.getElementById('potvrdaRINFO').innerHTML = "";
                    potvrda = true;
                } else {
                    $("#lozinkapotvrda").attr("style", "border: 3px solid red");
                    document.getElementById('potvrdaRINFO').innerHTML = "<span>Potvrda nije jednaka kao lozinka!</span><br>";
                    potvrda = false;
                }
            });

            $('#imeR').keyup(function () {
                var RegExpIme = new RegExp((/^(?!.*(.)\1{2})(?!.*[\d\s])(?!.*[^\w])(?=.*[A-Z][a-z]).{2,20}$/));
                var Rime = document.getElementById('imeR').value;
                var provjeraImena = RegExpIme.test(Rime);
                if (!provjeraImena) {
                    $("#imeR").attr("style", "border: 3px solid red");
                    ime = false;
                } else {
                    $("#imeR").attr("style", "none");
                    ime = true;
                }
            });

            $('#prezimeR').keyup(function () {
                var RegExpPrezime = new RegExp((/^(?!.*(.)\1{2})(?!.*[\d\s])(?!.*[^\w])(?=.*[A-Z][a-z]).{2,20}$/));
                var Rprezime = document.getElementById('prezimeR').value;
                var provjeraPrezimena = RegExpPrezime.test(Rprezime);
                if (!provjeraPrezimena) {
                    $("#prezimeR").attr("style", "border: 3px solid red");
                    prezime = false;
                } else {
                    $("#prezimeR").attr("style", "none");
                    prezime = true;
                }
            });

            $(document).keyup(function () {
                if (korime === true && email === true && lozinka === true && ime === true && prezime === true && potvrda === true) {
                    document.getElementById('registracijaButton').disabled = false;
                } else {
                    document.getElementById('registracijaButton').disabled = true;
                }
            });

        });
        break;
    case "Administracija":
        $(document).ready(function () {

            function getFromBase() {
                var brojElemenataBaza = $.ajax({
                    url: "./phpscripts/konfiguracijaDBupit.php",
                    method: "POST",
                    async: false,
                    success: function (data) {}

                }).responseText;

                return brojElemenataBaza;
            }

            var brojElemenata = parseInt(getFromBase());
            var zadnjiElement = 0;
            var pocetniElement = 0;
            var trenutnaStranica = 0;
            var odabir = "";
            var sortPrezime = "false";
            var sortStatus = "false";
            //var selektirano="";

            $(document).on("click", "#SortiranjeButtonRSK", function () {
                if (document.getElementById('prezimeKor').checked) {
                    sortPrezime = "true";
                    sortStatus = "false";
                    podaci_load();
                } else if (document.getElementById('stanjeRac').checked) {
                    sortPrezime = "false";
                    sortStatus = "true";
                    podaci_load();
                }
            });



            function podaci_load(odabir) {
                $.ajax({
                    url: "./phpscripts/upitiDB.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {stranica: "Administracija", sortPrezime: sortPrezime, sortStatus: sortStatus},
                    success:
                            function (data) {
                                var unos = "";

                                var tablica = document.getElementById('rad_s_korisnicima');
                                tablica.innerHTML = "<table border='1'>" +
                                        "<thead><tr style='text-align:center'>" +
                                        "<th width='25%'>Ime i prezime</th>" +
                                        "<th width='25%'><a>Uloga</a></th>" +
                                        "<th width='25%'>Status</th>" +
                                        "<th></th>" +
                                        "</tr>" +
                                        "</thead>" +
                                        "<tbody>" +
                                        "</tbody>" +
                                        "</table>";
                                var bodi = $('tbody');
                                var brojStranica = Math.ceil(data.length / brojElemenata);
                                pocetniElement = brojElemenata * trenutnaStranica;
                                zadnjiElement = pocetniElement + brojElemenata;
                                let paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);

                                if (odabir === "1") {
                                    trenutnaStranica = 0;
                                    pocetniElement = brojElemenata * trenutnaStranica;
                                    zadnjiElement = pocetniElement + brojElemenata;
                                    paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                                }
                                if (odabir === "2") {
                                    if (trenutnaStranica > 0)
                                        trenutnaStranica--;
                                    pocetniElement = brojElemenata * trenutnaStranica;
                                    zadnjiElement = pocetniElement + brojElemenata;
                                    paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                                }
                                if (odabir === "3") {
                                    if (trenutnaStranica < brojStranica - 1)
                                        trenutnaStranica++;
                                    pocetniElement = brojElemenata * trenutnaStranica;
                                    zadnjiElement = pocetniElement + brojElemenata;
                                    paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                                }
                                if (odabir === "4") {
                                    trenutnaStranica = brojStranica - 1;
                                    pocetniElement = brojElemenata * trenutnaStranica;
                                    zadnjiElement = pocetniElement + brojElemenata;
                                    paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                                }
                                for (var i = 0; i < paginatedItem.length; i++) {
                                    unos += "<tr style='text-align:center'>" +
                                            "<td>" + paginatedItem[i][1].ime_prezime + "</td>" +
                                            "<td>" + paginatedItem[i][1].uloga + "</td>" +
                                            "<td>" + paginatedItem[i][1].status + "</td>" +
                                            "<td><button id='" + paginatedItem[i][1].korisnik_id + "' name='" + paginatedItem[i][1].status + "'>Promjeni status</button></td>" +
                                            "</tr>";
                                }
                                bodi.html(unos);
                            }
                });
            }

            $(document).on('click', 'button', function () {
                $.ajax({
                    url: "./phpscripts/upitiDB.php",
                    method: "POST",
                    data: {stranica: "Administracija", promjenaID: this.id, status: this.name},
                    success: function () {}
                });
                podaci_load();
            });

            $(document).on("click", ".stranica_link", function () {
                odabir = $(this).attr("id");
                podaci_load(odabir);
            });
            podaci_load();

        });
        break;
    case "Svi korisnici":
        $(document).ready(function () {

            function getFromBase() {
                var brojElemenataBaza = $.ajax({
                    url: "../phpscripts/konfiguracijaDBupit.php",
                    method: "POST",
                    async: false,
                    success: function (data) {}

                }).responseText;

                return brojElemenataBaza;
            }

            var brojElemenata = parseInt(getFromBase());
            var zadnjiElement = 0;
            var pocetniElement = 0;
            var trenutnaStranica = 0;
            var odabir = "";
            var sortKorime = "false";
            var sortEmail = "false";

            $(document).on("click", "#SortiranjeButtonRSKK", function () {
                if (document.getElementById('korimeK').checked) {
                    sortKorime = "true";
                    sortEmail = "false";
                    podaci_load();
                } else if (document.getElementById('emailK').checked) {
                    sortKorime = "false";
                    sortEmail = "true";
                    podaci_load();
                }
            });

            function podaci_load(odabir) {
                $.ajax({
                    url: "../phpscripts/upitiDB.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {stranica: "Svi korisnici", sortKorime: sortKorime, sortEmail: sortEmail},
                    success: function (data) {
                        var unos = "";
                        var tablicaSVIHK = document.getElementById('popis_svih_korisnika');
                        tablicaSVIHK.innerHTML = "<table id='korisniciADMIN' border='1'>" +
                                "<thead><tr>" +
                                "<th>Korisničko ime</th>" +
                                "<th>Ime i prezime</th>" +
                                "<th>Email</th>" +
                                "<th>Lozinka</th>" +
                                "</tr>" +
                                "</thead>" +
                                "<tbody>" +
                                "</tbody>" +
                                "</table>";
                        var bodi = $('#korisniciADMIN tbody');
                        var brojStranica = Math.ceil(data.length / brojElemenata);
                        pocetniElement = brojElemenata * trenutnaStranica;
                        zadnjiElement = pocetniElement + brojElemenata;
                        let paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);

                        if (odabir === "1") {
                            trenutnaStranica = 0;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "2") {
                            if (trenutnaStranica > 0)
                                trenutnaStranica--;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "3") {
                            if (trenutnaStranica < brojStranica - 1)
                                trenutnaStranica++;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "4") {
                            trenutnaStranica = brojStranica - 1;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        for (var i = 0; i < paginatedItem.length; i++) {
                            unos += "<tr>" +
                                    "<td>" + paginatedItem[i][1].korisnicko_ime + "</td>" +
                                    "<td>" + paginatedItem[i][1].ime_prezime + "</td>" +
                                    "<td>" + paginatedItem[i][1].email + "</td>" +
                                    "<td>" + paginatedItem[i][1].lozinka + "</td>" +
                                    "</tr>";
                        }
                        bodi.html(unos);
                    }
                });
            }

            $(document).on("click", ".stranica_link", function () {
                odabir = $(this).attr("id");
                podaci_load(odabir);
            });
            podaci_load();

        });
        break;
    case "Matrijali korisnika":
        $(document).ready(function () {
            $.ajax({
                url: "./phpscripts/upitiDB.php",
                method: "POST",
                dataType: "JSON",
                data: {stranica: "Matrijali korisnika"},
                success: function (data) {
                    var ispisAV = "";
                    var ispisS = "";
                    var ispisP = "";

                    var galerijaMaterijala = document.getElementById('galerijaMaterijala');
                    galerijaMaterijala.innerHTML = "";
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].naziv_vrste_mat === "video" || data[i].naziv_vrste_mat === "audio") {
                            var link = data[i].poveznica_mat;
                            var embed = link.replace("watch?v=", "embed/");
                            ispisAV += "<iframe width='420' height='315' src='" + embed + "'></iframe>"
                        }
                        if (data[i].naziv_vrste_mat === "slika") {
                            ispisS += "<figure><img src='" + data[i].poveznica_mat + "' alt='" + data[i].naziv_materijala + "' width='420' height='315'><figcaption>" + data[i].naziv_materijala + "</figcaption></figure>"
                        }
                        if (data[i].naziv_vrste_mat === "pdf") {
                            ispisP += "<iframe width='420' height='315' src='" + data[i].poveznica_mat + "'></iframe>"
                        }

                        galerijaMaterijala.innerHTML += "<p>" + ispisS + "</p><p>" + ispisAV + "</p>" + ispisP + "<p></p><br>";

                        ispisAV = "";
                        ispisS = "";
                        ispisP = "";
                    }
                    if (galerijaMaterijala.innerHTML === "") {
                        galerijaMaterijala.innerHTML += "<p>NEMA DODANIH MATERIJALA!</p>";
                    }
                }
            });
        });
        break;
    case "Rezervacije":
        $(document).ready(function () {

            function getFromBase() {
                var brojElemenataBaza = $.ajax({
                    url: "./phpscripts/konfiguracijaDBupit.php",
                    method: "POST",
                    async: false,
                    success: function (data) {}

                }).responseText;

                return brojElemenataBaza;
            }

            var brojElemenata = parseInt(getFromBase());
            var zadnjiElement = 0;
            var pocetniElement = 0;
            var trenutnaStranica = 0;
            var odabir = "";

            function podaci_load(odabir) {
                $.ajax({
                    url: "./phpscripts/upitiDB.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {stranica: "Rezervacije"},
                    success: function (data) {
                        var unos = "";
                        //var opcije = "";
                        //var poljeSkijalista = [];
                        var tablicaNeOrgIzleta = document.getElementById('rezervacijaIzleta');
                        tablicaNeOrgIzleta.innerHTML = "<table id='izletiZaRez' border='1'>" +
                                "<thead><tr>" +
                                "<th>Naziv izleta</th>" +
                                "<th>Naziv skijališta</th>" +
                                "<th>Opis izleta</th>" +
                                "<th>REZERVIRAJ/PROMJENI</th>" +
                                "</tr>" +
                                "</thead>" +
                                "<tbody>" +
                                "</tbody>" +
                                "</table>";
                        var bodi = $('#izletiZaRez tbody');
                        var brojStranica = Math.ceil(data.length / brojElemenata);
                        pocetniElement = brojElemenata * trenutnaStranica;
                        zadnjiElement = pocetniElement + brojElemenata;
                        let paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);

                        if (odabir === "1") {
                            trenutnaStranica = 0;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "2") {
                            if (trenutnaStranica > 0)
                                trenutnaStranica--;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "3") {
                            if (trenutnaStranica < brojStranica - 1)
                                trenutnaStranica++;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        if (odabir === "4") {
                            trenutnaStranica = brojStranica - 1;
                            pocetniElement = brojElemenata * trenutnaStranica;
                            zadnjiElement = pocetniElement + brojElemenata;
                            paginatedItem = Object.entries(data).slice(pocetniElement, zadnjiElement);
                        }
                        for (var i = 0; i < paginatedItem.length; i++) {
                            unos += "<tr>" +
                                    "<td>" + paginatedItem[i][1].naziv_izleta + "</td>" +
                                    "<td>" + paginatedItem[i][1].naziv_skijalista + "</td>" +
                                    "<td>" + paginatedItem[i][1].opis_izleta + "</td>" +
                                    "<td><button onClick=\"window.location.href='./obrasci/unosRezervacije.php?idIzl=" + paginatedItem[i][1].izlet_id + "'\">Odaberi</button></td>" +
                                    "</tr>";
                        }
                        bodi.html(unos);
                    }
                });
            }

            $(document).on("click", ".stranica_link", function () {
                odabir = $(this).attr("id");
                podaci_load(odabir);
            });
            podaci_load();
        });
        break;
    case "Unos rezervacije":
        $(document).ready(function () {

            function prikazOstalihRez() {
                var ostaleRez = document.getElementById('ostaleRezervacije');
                ostaleRez.innerHTML = "";
                $.ajax({
                    url: "../phpscripts/upitDBbezstranicenja.php",
                    method: "POST",
                    data: {stranica: "Unos rezervacije"},
                    success: function (data) {
                        var unoKor = "";
                        const statPolje = JSON.parse(data);
                        ostaleRez.innerHTML = "<table id='ostaliKor' style='text-align:center' border='1'>" +
                                "<thead><tr>" +
                                "<th width='50%'>Ime i prezime</th>" +
                                "<th width='50%'>Rezervirana mjesta</th>" +
                                "</tr>" +
                                "</thead>" +
                                "<tbody>" +
                                "</tbody>" +
                                "</table>";
                        var statBodi = $('#ostaliKor tbody');
                        for (var i = 0; i < statPolje.length; i++) {
                            unoKor += "<tr>" +
                                    "<td>" + statPolje[i].ime_prezime + "</td>" +
                                    "<td>" + statPolje[i].br_rez_mjesta + "</td>" +
                                    "</tr>";
                        }
                        statBodi.html(unoKor);
                    }
                });
            }
            prikazOstalihRez();
        });
        break;
    case "Sve rezervacije":
        $(document).ready(function () {
            function prikazRezervacija() {
                var rezervacije = document.getElementById('popis_svih_rezervacija');
                rezervacije.innerHTML = "";
                $.ajax({
                    url: "./phpscripts/upitDBbezstranicenja.php",
                    method: "POST",
                    data: {stranica: "Sve rezervacije"},
                    success: function (data) {
                        var unoRez = "";
                        const rezPolje = JSON.parse(data);
                        rezervacije.innerHTML = "<table id='sviRez' style='text-align:center' border='1'>" +
                                "<thead><tr>" +
                                "<th>ID</th>" +
                                "<th>Ime i prezime</th>" +
                                "<th>Broj rezerviranih mjesta</th>" +
                                "</tr>" +
                                "</thead>" +
                                "<tbody>" +
                                "</tbody>" +
                                "</table>";
                        var rezBodi = $('#sviRez tbody');
                        for (var i = 0; i < rezPolje.length; i++) {
                            if(rezPolje[i].pristiglo_nakon_brmj === "1"){
                                unoRez += "<tr style='color:red'>" +
                                    "<td>" + rezPolje[i].rezervacija_id + "</td>" +
                                    "<td>" + rezPolje[i].ime_prezime + "</td>" +
                                    "<td>" + rezPolje[i].br_rez_mjesta + "</td>" +
                                    "</tr>";
                            } else {
                                unoRez += "<tr>" +
                                    "<td>" + rezPolje[i].rezervacija_id + "</td>" +
                                    "<td>" + rezPolje[i].ime_prezime + "</td>" +
                                    "<td>" + rezPolje[i].br_rez_mjesta + "</td>" +
                                    "</tr>";
                            }
                        }
                        rezBodi.html(unoRez);
                    }
                });
            }
            prikazRezervacija();
        });
        break;
    default:
        break;
}