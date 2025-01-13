<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
    <?php
    session_start();
    ?>
    <script>
        function search(param) {
            if (param.length == 0) {
                document.getElementById("result").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("result").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "search.php?q=" + param, true);
                xmlhttp.send();
                console.log(this.responseText);
            }
        }
    </script>
</head>

<body class="w3-green">
    <header>
        <center>
            <div class="w3-panel w3-red w3-xxlarge w3-serif"><i>Dershane İşlemleri Yönetim Sistemi</i></div>
            <div class="w3-bar w3-black">
                <a href="" class="w3-bar-item w3-button w3-mobile w3-gray">Ana Sayfa</a>
                <div class="w3-dropdown-hover w3-mobile">
                    <button class="w3-button">Öğrenci İşlemleri <i class="fa fa-caret-down"></i></button>
                    <div class="w3-dropdown-content w3-bar-content w3-bar-block w3-dark-grey">
                        <a href="/ÖğrenciKaydı.php" class="w3-bar-item w3-button w3-mobile">Öğrenci Kaydı</a>
                        <a href="/NotGirişi.php" class="w3-bar-item w3-button w3-mobile">Not Girişi</a>
                    </div>
                </div>
                <div class="w3-dropdown-hover w3-mobile">
                    <button class="w3-button">Finansal İşlemler <i class="fa fa-caret-down"></i></button>
                    <div class="w3-dropdown-content w3-bar-content w3-bar-block w3-dark-grey">
                        <a href="/Kasa.php" class="w3-bar-item w3-button w3-mobile">Kasa</a>
                        <a href="/Personel.php" class="w3-bar-item w3-button w3-mobile">Personel</a>
                        <a href="/FinansalTakip.php" class="w3-bar-item w3-button w3-mobile">Finansal Takip</a>
                    </div>
                </div>
                <input class="w3-bar-item w3-input w3-white w3-mobile" type="text" name="query" id="query" placeholder="🔍 Ara..." onkeyup="search(this.value)">
                <p>Sonuç: <span id="result"></span></p>
            </div>
        </center>
    </header>

    <center>
        <footer class="w3-display-bottommiddle">
            <p>
                <?php
                if (isset($_SESSION["name"])) {
                    echo "Hoşgeldiniz, " . $_SESSION["name"] . "!";
                } else {
                    header("Location: error.php");
                }
                ?>
            </p>
        </footer>
    </center>
</body>

</html>