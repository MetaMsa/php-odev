<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $conn = new PDO("mysql:host=$_ENV[MYSQL_DB_HOST];dbname=$_ENV[MYSQL_DB_NAME]", $_ENV['MYSQL_DB_USER_NAME'], $_ENV['MYSQL_DB_PASSWORD']);

    // Prepare and execute the query with parameterized values
    $sql = "SELECT * FROM users WHERE name = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $password]);
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        session_start();
        $_SESSION["name"] = $name;
        header("Location: home.php");
    } else {
        header("Location: index.php?state=error");
    }
}