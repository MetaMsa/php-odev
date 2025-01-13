<?php
include "db.php";
session_start();

if ($_SESSION["roles"] != "1") {
    header("Location: error.php");
}
else
{
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $id = $_GET["id"];
        $notId = $_GET["notId"];
        $sql = "INSERT INTO notlar (ogrenciId, notu) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id, 0]);
    
        header("Location: NotGirişi.php");
    }
}