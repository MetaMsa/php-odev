<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['namereg']), ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['emailreg'], FILTER_SANITIZE_EMAIL);
    $date = htmlspecialchars(trim($_POST['datereg']), ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars(trim($_POST['passwordreg']), ENT_QUOTES, 'UTF-8');
    $roles = htmlspecialchars(trim($_POST['rolereg']), ENT_QUOTES, 'UTF-8');
    $dershanead = htmlspecialchars(trim($_POST['dershaneadreg']), ENT_QUOTES, 'UTF-8');

    $sql = "SELECT * FROM users WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        header("Location: index.php?state=regerror");
    } else {
        // Dershane adını dershaneler tablosuna ekleyin
        $sql = "INSERT INTO dershaneler (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dershanead]);

        // Eklenen dershanenin ID'sini alın
        $dershane_id = $conn->lastInsertId();
        
        if($roles == "1"){
            $maas = 25000;
        }
        else if($roles == "2"){
            $maas = 50000;
        }

        // Kullanıcıyı users tablosuna ekleyin
        $sql = "INSERT INTO users (name, email, date, password, roles, dershane_id, maas) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $email, $date, $password, $roles, $dershane_id, $maas]);

        header("Location: index.php?state=regsuccess");
    }
}
?>