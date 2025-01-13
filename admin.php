<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
    <?php
    session_start();
    include "search.php";
    if ($_SESSION["roles"] != "2") {
        header("Location: error.php");
    }
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
                        document.getElementById("result").innerHTML = "<a href='./" + this.responseText.replace(/\s+/g, '') + ".php'>" + this.responseText + "</a>";
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
            <div class="w3-panel w3-red w3-xxlarge w3-serif"><i>Dershane İşlemleri Yönetim Sistemi Yönetici Paneli</i></div>
            <div class="w3-bar w3-black">
                <a href="" class="w3-bar-item w3-button w3-mobile w3-gray">Ana Sayfa</a>
                <a href="./logout.php" class="w3-bar-item w3-button w3-mobile w3-red">Çıkış Yap <i class="fa fa-times"></i></a>
                <div class="w3-dropdown-hover w3-mobile">
                    <button class="w3-button">Öğrenci İşlemleri <i class="fa fa-caret-down"></i></button>
                    <div class="w3-dropdown-content w3-bar-content w3-bar-block w3-dark-grey">
                        <a href="./Kayıt.php" class="w3-bar-item w3-button w3-mobile"><?php echo $page[0]; ?></a>
                    </div>
                </div>
                <div class="w3-dropdown-hover w3-mobile">
                    <button class="w3-button">Finansal/İdari İşlemler <i class="fa fa-caret-down"></i></button>
                    <div class="w3-dropdown-content w3-bar-content w3-bar-block w3-dark-grey">
                        <a href="./Personel.php" class="w3-bar-item w3-button w3-mobile"><?php echo $page[2]; ?></a>
                        <a href="./Kasa.php" class="w3-bar-item w3-button w3-mobile"><?php echo $page[1]; ?></a>
                        <a href="./MaaşTakibi.php" class="w3-bar-item w3-button w3-mobile"><?php echo $page[3]; ?></a>
                    </div>
                </div>
                <input class="w3-bar-item w3-mobile w3-input w3-white w3-mobile" type="text" name="query" id="query" placeholder="🔍 Ara..." onkeyup="search(this.value)">
                <span id="result"></span>
            </div>
        </center>
    </header>
    <center>
        <p class="w3-margin w3-padding w3-red w3-xxlarge w3-serif">
            <?php
                include "db.php";
                $sql = "SELECT * FROM dershaneler WHERE ID = " . $_SESSION["dershane_id"];
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                echo $result[0]["name"];
            ?>
            Dershanesi Öğrenci Listesi
        </p>
    </center>
    <main style="display:flex;flex-wrap:wrap;justify-content:center;">
        <?php
        include "db.php";
        $sql = "SELECT * FROM students WHERE dershane_id = " . $_SESSION["dershane_id"];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($result == null){
            echo "<div class='w3-card w3-mobile w3-margin w3-dark-grey' style='width:20rem;'>
            <div class='w3-container w3-center'>
                <h3>
                    Öğrenci Bulunamadı
                </h3>
            </div>";
        }
        else{
            foreach ($result as $row) {
                echo "<div class='w3-card w3-mobile w3-margin w3-dark-grey' style='width:20rem;'>
                <div class='w3-container w3-center'>
                    <h3>
                         " . $row['Ad'] . "
                    </h3>
                    <i class='fa fa-user'></i>
                    <h4>
                        " . $row['Sinif'] . ". Sınıf
                    </h4>
                    <h5>
                       Öğrenci Numarası: " . $row['ID'] . "
                    </h5>
                    <h6>
                        <i class='fa fa-money'></i>
                        Kayıt Ücreti: " . $row['ucret'] . "
                    </h6>
                    <a href='./deletestudent.php?id=" . $row['ID'] . "' class='w3-button w3-red w3-border w3-border-black w3-round-large'>
                        <i class='fa fa-trash'></i>
                        Sil
                    </a>
                </div>
            </div>";
            }
        }
        ?>
    </main>
    <footer>
        <center>
            <p>
                <?php
                if (isset($_SESSION["name"]) && isset($_SESSION["roles"]) && $_SESSION["roles"] == "2") {
                    echo "Hoşgeldiniz, " . $_SESSION["name"] . "!";
                }
                ?>
            </p>
        </center>
    </footer>
</body>

</html>