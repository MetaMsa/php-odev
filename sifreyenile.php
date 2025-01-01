<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifremi Unuttum</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="">
    <script type="text/javascript" src="index.js"></script>
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
</head>

<body class="w3-green">
    <header>
        <a href="./index.php" class="w3-margin w3-bar-item w3-button w3-red"><i class="fa-solid fa-arrow-left"></i></a>
    </header>
    <main>
        <form class="w3-display-middle" action="sifreyenile.php" method="post" style="width: fit-content;">
            <label for="name">Kullanıcı Adı</label><br>
            <input class="w3-input w3-hover-yellow w3-animate-input" type="text" name="name" id="name" style="width: 70%;" required><br>
            <label for="eposta">E-Posta</label><br>
            <input class="w3-input w3-hover-yellow w3-animate-input" type="email" name="eposta" id="eposta" style="width: 70%;" required><br>
            <label for="sifre">Yeni Şifre</label><br>
            <input class="w3-input w3-hover-yellow w3-animate-input" type="password" name="sifre" id="sifre" style="width: 70%;" required><br>
            <button type="submit" class="w3-button w3-green w3-border w3-border-red w3-round-large">
                <i class="fa-solid fa-plus"></i>
                Şifre Yenile</button>
        </form>
    </main>
    <?php
        include "db.php";  
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $eposta = $_POST["eposta"];
            $sifre = $_POST["sifre"];
            $sql = "SELECT * FROM users WHERE name = ? AND email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $eposta]);
            $result = $stmt->fetchAll();
            if (count($result) == 1) {
                $sql = "UPDATE users SET password = ? WHERE name = ? AND email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$sifre, $name, $eposta]);
                echo "<script>alert('Şifreniz: $sifre');</script>";
            } else {
                echo "<script>alert('Kullanıcı adı veya e-posta hatalı!');</script>";
            }
        }
    ?>
    <footer>

    </footer>
</body>

</html>