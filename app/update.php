<!-- 更新処理 -->

<?php
require 'db.php';

$sql = "UPDATE products SET name=?, maker=?, price=?, stock=?, comment=? WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['maker'],
    $_POST['price'],
    $_POST['stock'],
    $_POST['comment'],
    $_POST['ID'],
]);

header("Location: login.php");
exit;