Kodunuzdaki Güvenlik Açığı ve Düzeltme

Verdiğiniz kodda, SQL injection açığı bulunmaktadır. Bu, kötü niyetli kullanıcıların SQL sorgularını manipüle ederek veritabanınıza erişmelerine veya verileri değiştirmelerine izin verebilir.

Güvenlik Açığının Nedeni:

Direct SQL Injection: Kullanıcı tarafından sağlanan $name ve $password değerleri doğrudan SQL sorgusuna ekleniyor. Bu, SQL injection saldırılarına açık hale getirir.
Çözüm: Prepared Statements Kullanımı

Prepared statements, SQL sorgularını ve verileri ayrı tutarak SQL injection riskini en aza indirir.

PHP
<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $conn = new PDO("mysql:host=$_ENV[DE_MYSQL_DB_HOST];dbname=$_ENV[DE_MYSQL_DB_NAME]", $_ENV['DE_MYSQL_DB_USER_NAME'], $_ENV['DE_MYSQL_DB_PASSWORD']);

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