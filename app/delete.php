<!-- 削除処理ページ -->

<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "IDが指定さてれいません。";
    exit;
}

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: login.php");
exit;
