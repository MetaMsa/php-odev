<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Kaydı</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="">
    <script type="text/javascript" src="index.js"></script>
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
    <?php
    session_start();
    if ($_SESSION["roles"] != "2") {
        header("Location: error.php");
    }
    ?>
</head>

<body class="w3-green">
    <header>
        <a href="./admin.php" class="w3-margin w3-bar-item w3-button w3-red"><i class="fa-solid fa-arrow-left"></i></a>
    </header>
    <main>
        <p>
            Türkçe karakterler kullanmayınız!
        </p>
        <form class="w3-display-middle w3-topbar w3-bottombar w3-border-red" action="Kayıt.php" method="post" style="width: fit-content;">
            <label for="name">Adı</label><br>
            <input class="w3-input w3-hover-yellow w3-animate-input" type="text" name="name" id="name" style="width: 70%;" required><br>
            <select class="w3-select" name="option" required>
                <option value="" disabled selected>Sınıf Seçiniz...</option>
                <option value="9">9.Sınıf</option>
                <option value="10">10.Sınıf</option>
                <option value="11">11.Sınıf</option>
                <option value="12">12.Sınıf</option>
            </select>

            <input name="Servis" class="w3-check" type="checkbox">
            <label>Servis Hizmeti Alacak</label>

            <input name="Yemek" class="w3-check" type="checkbox">
            <label>Yemek Hizmeti Alacak</label>
            <br>

            <button type="submit" class="w3-margin w3-button w3-green w3-border w3-border-red w3-round-large">
                <i class="fa-solid fa-plus"></i>
                Kayıt Yap</button>
        </form>
        <?php
        include "db.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $option = $_POST["option"];

            if ($option == "9") {
                $ücret = 10000;
            } else if ($option == "10") {
                $ücret = 20000;
            } else if ($option == "11") {
                $ücret = 30000;
            } else if ($option == "12") {
                $ücret = 40000;
            }

            if (isset($_POST["Servis"]) && isset($_POST["Yemek"])) {
                $servis = $_POST["Servis"];
                $yemek = $_POST["Yemek"];

                if ($servis == "on") {
                    $ücret += 5000;
                }

                if ($yemek == "on") {
                    $ücret += 5000;
                }
            }

            $sql = "INSERT INTO students (Ad, Sinif, ucret, dershane_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $option, $ücret, $_SESSION["dershane_id"]]);
            echo "<div class='w3-display-bottommiddle w3-panel w3-green w3-border w3-border-red w3-round-large' style='width: fit-content;'><p>Kayıt başarılı!</p></div>";

            $ogrenciId = $conn->lastInsertId();
            $sql = "INSERT INTO notlar (ogrenciId, notu) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ogrenciId, 0]);
        }
        ?>
    </main>
    <footer>

    </footer>
</body>

</html>