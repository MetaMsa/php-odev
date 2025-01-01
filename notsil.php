<?php
include "db.php";
session_start();
if($_SESSION["roles"] != "1"){
    header("Location: error.php");
}
else{
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $notId = $_POST["notId"];
        $sql = "DELETE FROM notlar WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$notId]);
        header("Location: NotGirişi.php");
    }
}