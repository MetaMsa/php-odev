<?php
    require_once realpath(__DIR__ . "/vendor/autoload.php");

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $conn = new PDO("mysql:host=$_ENV[DE_MYSQL_DB_HOST];dbname=$_ENV[DE_MYSQL_DB_NAME]", $_ENV['DE_MYSQL_DB_USER_NAME'], $_ENV['DE_MYSQL_DB_PASSWORD']);
?>