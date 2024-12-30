<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personel Listesi</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
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
    <p class="w3-margin w3-center w3-padding w3-red w3-xxlarge w3-serif">
        Personel Listesi
    </p>
    <p class="w3-margin w3-center w3-padding w3-red w3-serif">
        Sadece rolü öğretmen olan kullanıcılar silinebilir.
    </p>
    <main style="display:flex;flex-wrap:wrap;justify-content:center;">
        <?php
        include "db.php";
        $sql = "SELECT * FROM users WHERE dershane_id = " . $_SESSION["dershane_id"];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            echo "<div class='w3-card-4 w3-mobile w3-border w3-border-black w3-round w3-margin' style='width: 20%;'>";
            echo "<div class='w3-container" . ($row["roles"] == 1 ? " w3-blue" : " w3-red") . "'>";
            echo "<h2>" . $row["name"] . "</h2>";
            echo "</div>";
            echo "<div class='w3-container'>";
            echo "<p><b>Personel Numarası:</b> " . $row["ID"] . "</p>";
            echo "<p><b>Rolü:</b> " . ($row["roles"] == 1 ? "Öğretmen" : "Yönetici") . "</p>";
            if ($row["roles"] == 1) {
                echo "<a href='./deleteteacher.php?id=" . $row['ID'] . "' class='w3-button w3-red w3-border w3-border-black w3-round-large'>
                            <i class='fa fa-trash'></i>
                            Sil
                        </a>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </main>
    <footer>

    </footer>
</body>

</html>