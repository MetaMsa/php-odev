<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 text-center">

            </div>

            <div class="col-md-6 text-center">
                <h1>Giriş</h1>
                <form action="index.php" method="post">
                    <div class="m-5 p-5">
                        <label for="name" class="form-label">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="m-5 p-5">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Giriş Yap</button>
                </form>
            </div>

            <div class="col-md-3 text-center">

            </div>
        </div>
</body>

<?php
$servername = "sql103.infinityfree.com";
$username = "if0_37485059";
$password = "zoLDN1jlNtVU3al";
$dbname = "if0_37485059_odev";

$de_servername = "localhost";
$de_username = "root";
$de_password = "";
$de_dbname = "if0_37485059_odev";

try {
    $conn = new PDO("mysql:host=$de_servername;dbname=$de_dbname", $de_username, $de_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<center> Bağlantı başarılı! </center>";
} catch (PDOException $e) {
    echo "<center> Bağlantı hatası: </center>" . $e->getMessage();
}
?>

</html>