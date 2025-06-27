<?php
$host = 'localhost';
$dbname = 'test15';  
// ↑自分のデータベース名に変更
$user = 'root';
$pass = 'root';
// ↑MAMPの初期設定（変更してなければ）
$dsn = "mysql:host=localhost;port=8889;dbname=test15;charset=utf8";

try {
    $pdo = new PDO("mysql:host=localhost;port=8889;dbname=test15;charset=utf8", "root", "root");
    // echo "接続成功";
} catch (PDOException $e) {
    echo "DB接続エラー： " . $e->getMessage();
    exit;
} 

