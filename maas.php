<?php
include "db.php";
session_start();
if($_SESSION["roles"] != "2"){
    header("Location: error.php");
}
else{
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $sql = "SELECT roles FROM users WHERE ID = " . $_GET["id"];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        $sql = "INSERT INTO maaslar (userId, miktar, tarih) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_GET["id"], $result["roles"] == 1 ? 25000 : 50000, date("Y-m-d")]);
        header("Location: MaaşTakibi.php");
    }
}