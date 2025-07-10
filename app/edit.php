<!-- 編集画面 -->

<?php

require_once 'models/ProductModel.php';
ob_start(); 
// ↑出力バッファリングを開始（これ重要！！）

$id = $_GET['id'] ?? null;
if (!$id) {
    exit('IDが指定されていません。');
}

// 商品データの取得
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    exit('商品が見つかりません。');
}

$error ='';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $maker = $_POST['maker'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $comment=$_POST['comment'] ?? '';
    $image_path = $product['image_path'] ?? '';

    // 画像が新しくアップロードされた場合
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $target = 'images/' . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = $target;
        } else {
            $error = "画像のアップロードに失敗しました。";
        }
    }
}

// 入力チェック
if ($name && $maker && $price && $stock && !$error) {
    $stmt = $pdo->prepare("UPDATE products SET name=?, maker=?, price=?, stock=?, comment=?, image_path=? WHERE id=?");
    $stmt->execute([$name, $maker, $price, $stock, $comment, $image_path, $id]);
    header("Location: login.php");
    exit;
} else {
    if (!$error) $error = "必要項目をすべて入力してください。";
}

ob_end_flush();
// ↑出力バッファ終了（オプション）
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報編集画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

    <h1>商品情報編集画面</h1>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error)?></p>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
    <p>商品名*: <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required></p>
    <p>メーカー名*: <input type="text" name="maker" value="<?= htmlspecialchars($product['maker']) ?>" required></p>
    <p>価格*: <input type="number" name="price" value="<?= $product['price'] ?>" required></p>
    <p>在庫数*: <input type="number" name="stock" value="<?= $product['stock'] ?>" required></p>
    <p>コメント: <input type="text" name="comment" value="<?= htmlspecialchars($product['comment']) ?>"></p>
    <p>現在の画像：<br>
        <?php if ($product['image_path']): ?>
            <img src="<?= htmlspecialchars($product["image_path"]) ?>" width="100">
            <?php endif; ?>
            新しい画像: <input type="file" name="image" accept="image/*">
</p>

<button type="submit" style="background: orange;">更新する</button>
<a href="login.php"><button type="button" style="background: skyblue;">戻る</button></a>
    </form>
    </div>
</body>
</html>
