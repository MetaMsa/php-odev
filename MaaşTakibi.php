<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maaş Takibi</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
    <?php
    session_start();
    if (!isset($_SESSION["name"])) {
        header("Location: error.php");
    }
    ?>
</head>

<body class="w3-green">
    <header>
        <a href="<?php echo $_SESSION["roles"] == 1 ? './teacher.php' : './admin.php';  ?>" class="w3-margin w3-bar-item w3-button w3-red"><i class="fa-solid fa-arrow-left"></i></a>
    </header>
    <p class="w3-margin w3-center w3-padding w3-red w3-xxlarge w3-serif">
        Maaş Takibi (<?php echo $_SESSION["roles"] == 1 ? "Öğretmen" : "Yönetici";  ?> Paneli)
    </p>
    <main style="display:flex;flex-wrap:wrap;justify-content:center;">
        <?php
        include "db.php";
        if ($_SESSION["roles"] == 2) {
            $sql = "SELECT * FROM users WHERE dershane_id = " . $_SESSION["dershane_id"];
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $row) {
                echo "<p class='w3-mobile w3-yellow w3-leftbar w3-rightbar w3-border-black' style='width: 20%;'>";
                echo $row["name"];
                echo "<br> Personel Numarası:" . $row["ID"];
                echo "<br> Rolü: " . ($row["roles"] == 1 ? "Öğretmen" : "Yönetici");
                $sql = "SELECT * FROM maaslar WHERE userId = " .  $row["ID"];
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result1 = $stmt->fetchAll();
                for ($i = 0; $i < count($result1); $i++) {
                    echo "<br> Maaş Ödemesi: ";
                    echo $result1[$i]['miktar'] . " ";
                    echo "<br> Ödeme Tarihi: ";
                    echo $result1[$i]['tarih'] . " ";
                }
                echo "<br><br><a href='maas.php?id=" . $row["ID"] . "' class='w3-button w3-green w3-border w3-border-black w3-round-large'>+ Yeni maaş öde <i class='fa fa-money '></i></a>";
                echo "</p>";
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $maas = $_POST["maas"];
                $sql = "UPDATE users SET maas = " . $maas . " WHERE ID = " . $row["ID"];
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                header("Location: MaaşTakibi.php");
            }
        } else {
            $sql = "SELECT * FROM users WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_SESSION["ID"]]);
            $result = $stmt->fetchAll();

            echo "<p class='w3-mobile w3-xxlarge w3-yellow w3-leftbar w3-rightbar w3-border-black'>";
            echo "Adım:" . $result[0]['name'];
            echo "<br> Personel Numaram:" . $result[0]["ID"];
            echo "<br> Rolüm: " . ($result[0]["roles"] == 1 ? "Öğretmen" : "Yönetici");
            $sql = "SELECT * FROM maaslar WHERE userId = " .  $result[0]["ID"];
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result1 = $stmt->fetchAll();
            for ($i = 0; $i < count($result1); $i++) {
                echo "<br> Maaş Ödemelerim: ";
                echo $result1[$i]['miktar'] . " ";
                echo "<br> Ödeme Tarihi: ";
                echo $result1[$i]['tarih'] . " ";
            }
            echo "</p>";
        }
        ?>
    </main>
    <footer>

    </footer>
</body>

</html>