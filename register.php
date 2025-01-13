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
        $sql = "SELECT * FROM dershaneler WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dershanead]);
        $result1 = $stmt->fetchAll();

        if (count($result1) > 0) {
            $dershane_id = $result1[0]["ID"];
            if ($roles == "1") {
                $maas = 25000;
            } else if ($roles == "2") {
                $maas = 50000;
            }
            $sql = "INSERT INTO users (name, email, date, password, roles, dershane_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $email, $date, $password, $roles, $dershane_id]);

            $user_id = $conn->lastInsertId();
            
            if ($roles == "1") {
                $sql = "INSERT INTO maaslar (userId, miktar, tarih) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$user_id, 25000, date("Y-m-d")]);
            } else if ($roles == "2") {
                $sql = "INSERT INTO maaslar (userId, miktar, tarih) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$user_id, 50000, date("Y-m-d")]);
            }

            header("Location: index.php?state=regsuccess");
        } else {
            // Dershane adını dershaneler tablosuna ekleyin
            $sql = "INSERT INTO dershaneler (name) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$dershanead]);

            $dershane_id_1 = $conn->lastInsertId();

            // Kullanıcıyı users tablosuna ekleyin
            $sql = "INSERT INTO users (name, email, date, password, roles, dershane_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $email, $date, $password, $roles, $dershane_id_1]);

            $user_id1 = $conn->lastInsertId();
            
            if ($roles == "1") {
                $sql = "INSERT INTO maaslar (userId, miktar, tarih) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$user_id1, 25000, date("Y-m-d")]);
            } else if ($roles == "2") {
                $sql = "INSERT INTO maaslar (userId, miktar, tarih) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$user_id1, 50000, date("Y-m-d")]);
            }

            header("Location: index.php?state=regsuccess");
        }
    }
}
