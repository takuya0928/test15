<!-- 登録処理画面 -->


<?php
require 'db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$sql = "INSERT INTO products (name, maker, price, stock, comment) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['maker'],
    $_POST['price'],
    $_POST['stock'],
    $_POST['comment']
]);

header("Location: login.php");
exit;
