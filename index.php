<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="">
    <script type="text/javascript" src="index.js"></script>
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
    <?php
        session_start();
        if(isset($_SESSION["name"]) && isset($_SESSION["roles"]) && $_SESSION["roles"] == "2"){
            header("Location: admin.php");
        }if(isset($_SESSION["name"]) && isset($_SESSION["roles"]) && $_SESSION["roles"] == "1"){
            header("Location: teacher.php");
        }
    ?>
</head>

<body class="w3-green">
    <center>
        <header>
            <div class="w3-panel w3-red w3-xxlarge w3-serif"><i>Dershane İşlemleri Yönetim Sistemi</i></div>
        </header>
        <main>
            <p>
                Türkçe karakterler kullanmayınız!

                Yöneticiler öğrenci ekleyip silebilir ve personel maaşlarını düzenleyebilir.
                Öğretmenler var olan öğrencilere not girebilir ve öğrenci notlarını görebilir.
            </p>
            <div style="width: fit-content;" class="login w3-card-4 w3-border w3-border-black w3-round w3-animate-zoom" id="login">
                <div class="w3-container w3-blue">
                    <h1>Giriş</h1>
                </div>
                <form class="w3-container w3-white w3-padding-16" action="login.php" method="post">
                    <div>
                        <label for="name">Kullanıcı Adı</label><br>
                        <input class="w3-input w3-hover-yellow w3-animate-input" type="text" id="name" name="name" style="width:50%" required>
                    </div>
                    <div>
                        <label for="password">Şifre</label><br>
                        <input class="w3-input w3-hover-yellow w3-animate-input" type="password" id="password" name="password" style="width:50%" required>
                    </div><br>
                    <button type="submit" class="w3-button w3-green w3-border w3-border-red w3-round-large">
                        <i class="fa-solid fa-right-to-bracket">

                        </i>
                        Giriş Yap</button><br><br>
                        <a href="sifreyenile.php">Şifremi Unuttum</a>
                </form>
                
                <div class="error w3-red">
                    <?php
                    if (isset($_GET["state"]) && $_GET["state"] == "error") {
                        echo "<p>Kullanıcı adı veya şifre hatalı!</p>";
                    }
                    if (isset($_GET["state"]) && $_GET["state"] == "regerror") {
                        echo "Bu kullanıcı adı zaten kullanımda!";
                    }
                    ?>
                </div>
                <div class="success">
                    <?php
                    if (isset($_GET["state"]) && $_GET["state"] == "regsuccess") {
                    echo "Kayıt başarılı!";
                    }
                    ?>
                </div>
            </div>

            <div style="width: fit-content; display:none;" class="register w3-card-4 w3-border w3-border-black w3-round w3-animate-zoom" id="register">
                <div class="w3-container w3-cyan">
                    <h1>Kayıt Ol</h1>
                </div>
                <form class="w3-container w3-white w3-padding-16" action="register.php" method="post">
                    <div>
                        <label for="namereg">Kullanıcı Adı</label><br>
                        <input class="w3-input w3-hover-yellow w3-animate-input" type="text" id="namereg" name="namereg" style="width:50%" required>
                    </div>
                    <div>
                        <label for="datereg">Doğum Tarihi</label><br>
                        <input class="w3-input w3-hover-yellow w3-animate-input" type="date" id="datereg" name="datereg" style="width:50%" required>
                    </div>
                    <div>
                        <select class="w3-select w3-hover-yellow w3-animate-input" name="rolereg" id="rolereg" style="width:50%" required>
                            <option value="" disabled selected>Rol Seçiniz...</option>
                            <option value="1">Öğretmen</option>
                            <option value="2">Yönetici</option>
                        </select>
                    </div>
                    <div>
                        <label for="dershaneadreg">Dershane Adı</label><br>
                        <input class="w3-input w3-hover-yellow w3-animate-input" type="text" id="dershaneadreg" name="dershaneadreg" style="width:50%" required>
                    </div>
                    <div>
                        <label for="emailreg">E-Posta</label><br>
                        <input class="w3-input w3-hover-yellow w3-animate-input" type="email" id="emailreg" name="emailreg" style="width:50%" required>
                    </div>
                    <div>
                        <label for="passwordreg">Şifre</label><br>
                        <input class="w3-input w3-hover-yellow w3-animate-input" type="password" id="passwordreg" name="passwordreg" style="width:50%" required>
                    </div><br>
                    <button type="submit" class="w3-button w3-green w3-border w3-border-red w3-round-large">
                        <i class="fa-solid fa-user-plus">

                        </i>
                        Kayıt Ol</button>
                </form>
            </div>
            <button id="btn" class="w3-button w3-yellow" onclick="change()">
                Kayıt Ol
            </button>
        </main>
        <footer class="w3-mobile w3-xlarge w3-serif w3-text-black">
            Mehmet Serhat ASLAN
        </footer>
    </center>
</body>

</html>