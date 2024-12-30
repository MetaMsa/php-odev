<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = htmlspecialchars(trim($_GET['id']), ENT_QUOTES, 'UTF-8');

    $sql = "DELETE FROM users WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    header("Location: admin.php");
}