<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğretmen</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
    <?php
    session_start();
    include "searchteacher.php";
    if ($_SESSION["roles"] != "1") {
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
                xmlhttp.open("GET", "searchteacher.php?q=" + param, true);
                xmlhttp.send();
                console.log(this.responseText);
            }
        }
    </script>
</head>

<body class="w3-green">
    <header>
        <center>
            <div class="w3-panel w3-red w3-xxlarge w3-serif"><i>Dershane İşlemleri Yönetim Sistemi Öğretmen Paneli</i></div>
            <div class="w3-bar w3-black">
                <a href="" class="w3-bar-item w3-button w3-mobile">Ana Sayfa</a>
                <a href="./logout.php" class="w3-bar-item w3-button w3-mobile w3-red">Çıkış Yap <i class="fa fa-times"></i></a>
                <a href="./MaaşTakibi.php" class="w3-bar-item w3-button w3-mobile"><?php echo $page[0]; ?></a>
                <a href="./NotGirişi.php" class="w3-bar-item w3-button w3-mobile"><?php echo $page[1]; ?></a>
                <input class="w3-bar-item w3-input w3-white w3-mobile" type="text" name="query" id="query" placeholder="🔍 Ara..." onkeyup="search(this.value)">
                <span id="result"></span>
            </div>
        </center>
    </header>

    <main style="display:flex;flex-wrap:wrap;justify-content:center;">
        <?php
        include "db.php";
        $sql = "SELECT * FROM students WHERE dershane_id = " . $_SESSION["dershane_id"];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        if(count($result) == 0) {
            echo "<p class='w3-card w3-margin w3-dark-grey w3-container w3-center w3-mobile w3-yellow w3-leftbar w3-rightbar w3-border-black' style='width: 20%;'>Öğrenci bulunamadı.</p>";
        }
        else{
            foreach ($result as $row) {
                echo "<p class='w3-card w3-margin w3-dark-grey w3-container w3-center w3-mobile w3-yellow w3-leftbar w3-rightbar w3-border-black' style='width: 20%;'>";
                echo $row["Ad"];
                echo "<br> Öğrenci Numarası:" . $row["ID"];
                echo "<br> Notu: ";
                $Id = $row["ID"];
                $sql = "SELECT * FROM notlar WHERE ogrenciId = $Id";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result1 = $stmt->fetchAll();
                echo $result1[0]['notu'] . " ";
                echo "</p>";
            }
        }
        ?>
    </main>

    <center>
        <footer>
            <p>
                <?php
                if (isset($_SESSION["name"]) && isset($_SESSION["roles"]) && $_SESSION["roles"] == "1") {
                    echo "Hoşgeldiniz, " . $_SESSION["name"] . " öğretmen!";
                }
                ?>
            </p>
        </footer>
    </center>
</body>

</html>