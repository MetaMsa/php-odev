<?php
    require_once realpath(__DIR__ . "/vendor/autoload.php");

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $conn = new PDO("mysql:host=localhost;dbname=if0_37485059_odev", "root", "");
?>