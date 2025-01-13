<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

    // Prepare and execute the query with parameterized values
    $sql = "SELECT * FROM users WHERE name = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $password]);
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        session_start();
        $_SESSION["name"] = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $_SESSION["roles"] = $result[0]["roles"];
        $_SESSION["dershane_id"] = $result[0]["dershane_id"];
        $_SESSION["ID"] = $result[0]["ID"];
        
        if($result[0]["roles"] == "2")
            header("Location: admin.php");
        else if($result[0]["roles"] == "1")
            header("Location: teacher.php");
    } else {
        header("Location: index.php?state=error");
    }
}
?>