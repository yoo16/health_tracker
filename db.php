<?php
$connection = DB_CONNECTION;
$host = DB_HOST;
$name = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;

$dsn = "$connection:host=$host;dbname=$name;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    exit('DB接続エラー: ' . $e->getMessage());
}
