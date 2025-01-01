<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Girişi</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
    <?php
    session_start();
    if ($_SESSION["roles"] != "1") {
        header("Location: error.php");
    }
    ?>
</head>

<body class="w3-green">
    <header>
        <a href="./teacher.php" class="w3-margin w3-bar-item w3-button w3-red"><i class="fa-solid fa-arrow-left"></i></a>
    </header>
    <p class="w3-margin w3-center w3-padding w3-red w3-xxlarge w3-serif">
        Not Girişi (<?php echo $_SESSION["roles"] == 1 ? "Öğretmen" : "Yönetici";  ?> Paneli)
    </p>
    <p class='w3-margin w3-center w3-padding w3-red w3-serif'>
        Sadece öğretmenler notları düzenleyebilir.
    </p>
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
                $Id = $row["ID"];
                $count = 1;
                echo "<p class='w3-mobile w3-yellow w3-leftbar w3-rightbar w3-border-black' style='width: 20%;'>";
                echo "Adı:" . $row["Ad"];
                echo "<br> Öğrenci Numarası:" . $row["ID"];
                $sql = "SELECT * FROM notlar WHERE ogrenciId = " .  $Id;
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result1 = $stmt->fetchAll();
                for($i = 0; $i < count($result1) ; $i++){
                    echo "<br> Notu: " ;
                    echo $result1[$i]['notu'] . " ";
                    echo "<a href='not.php?id=" . $Id . "&notId=" . $result1[$i]['ID'] . "' class='w3-button w3-red w3-border w3-border-black w3-round-large'><i class='fa fa-edit'></i></a>";
                }
                echo "<br><a href='notekle.php?id=$Id' class='w3-button w3-white w3-border w3-border-black w3-round-large'><i class='fa fa-plus'></i>Not Ekle</a>";
                echo "</p>";
            }
        }
        ?>
    </main>
    <footer>

    </footer>
</body>

</html>