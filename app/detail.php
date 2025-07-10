<!-- 詳細表示ページ -->
<?php

require_once 'models/ProductModel.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "IDが指定されていません。";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "商品が見つかりません。";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報詳細画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>商品情報詳細画面</h1>
    <p>ID: <?= htmlspecialchars($product['id']) ?></p>
    <p>商品名: <?= htmlspecialchars($product['name']) ?></p>
    <p>メーカー: <?= htmlspecialchars($product['maker']) ?></p>
    <p>価格: ￥<?= htmlspecialchars($product['price']) ?></p>
    <p>在庫数: <?= htmlspecialchars($product['stock']) ?></p>
    <p>コメント: <?= nl2br(htmlspecialchars($product['comment'])) ?></p>
    <p><img src="<?= htmlspecialchars($product['image_path']) ?>" width="100"></p>
    <a href="login.php">戻る</a>
    <a href="edit.php?id=<?= $product['id'] ?>">編集</a>
    </div>
</body>
</html>