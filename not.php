<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="">
    <script type="text/javascript" src="index.js"></script>
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
        <a href="./NotGirişi.php" class="w3-margin w3-bar-item w3-button w3-red"><i class="fa-solid fa-arrow-left"></i></a>
    </header>
    <main>
        <?php
        include "db.php";
        
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = htmlspecialchars(trim($_GET['id']), ENT_QUOTES, 'UTF-8');

            $sql = "SELECT * FROM students WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();


            echo "<form class='w3-display w3-display-middle
        -middle w3-topbar w3-bottombar w3-border-red' action='not.php' method='post' style='width: fit-content;'>";
            echo "<label for='maas'>Not (100 üzerinden)</label><br>";
            echo "<input class='w3-input w3-hover-yellow w3-animate-input' type='text' name='not' id='not' style='width: 70%;' value='" . $result['notu'] . "' required><br>";
            echo "<input type='hidden' name='id' value='" . $result['ID'] . "'>";
            echo "<button type='submit' class='w3-margin w3-button w3-green w3-border w3-border-red w3-round-large'>
            <i class='fa-solid fa-plus'></i>
            Kayıt Yap</button>";
            echo "</form>";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $not = $_POST["not"];
            $id = $_POST["id"];
            $sql = "UPDATE students SET notu = ? WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$not, $id]);
            header("Location: NotGirişi.php");
        }
        ?>
    </main>
    <footer>

    </footer>
</body>

</html>