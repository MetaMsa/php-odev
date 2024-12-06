<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_var($_POST['namereg'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['emailreg'], FILTER_SANITIZE_EMAIL);
    $date = filter_var($_POST['datereg'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['passwordreg'], FILTER_SANITIZE_STRING);;  

    $conn = new PDO("mysql:host=$_ENV[MYSQL_DB_HOST];dbname=$_ENV[MYSQL_DB_NAME]", $_ENV['MYSQL_DB_USER_NAME'], $_ENV['MYSQL_DB_PASSWORD']);

    $sql = "SELECT * FROM users WHERE name = '$username'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        header("Location: index.php?state=regerror");
    } else {
        $sql = "INSERT INTO users (name, email, date, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $email, $date, $password]);
        header("Location: index.php?state=regsuccess");
    }
}
