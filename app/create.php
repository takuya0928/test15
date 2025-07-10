<!-- 新規登録ページ -->
<?php

require_once 'models/ProductModel.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $maker = $_POST['maker'] ?? '';

    $comment = $_POST['comment'] ?? '';
    $image_path =  '';

    // 入力チェック
    if ($name === '' || $maker === '' || $price === '' || $stock === '') {
        $error = '必要な項目が入力されていません。';
    } elseif (!is_numeric($price) || !is_numeric($stock)) {
        $error = '価格と在庫数は数値で入力してください。';
    }

    // 画像アップロード処理
    if (!$error && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $target = 'images/' . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            $image_path = $target;
        } else {
            $error = '画像アップロード失敗';
        }
    }

    // DB登録処理

    if (!$error) {
        $price = (int)$price;
        $stock = (int)$stock;
        ProductModel::create($name, $maker, $price, $stock, $comment, $image_path);
        header("Location: login.php");
        exit;
    }
}

    

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品新規登録画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>商品新規登録画面</h1>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="create.php" method="post" enctype="multipart/form-data">
        <p>商品名*: <input type="text" name="name" required></p>
        <p>メーカー名*: <input type="text" name="maker" required></p>
        <p>価格*: <input type="number" name="price" required></p>
        <p>在庫数*: <input type="number" name="stock" required></p>
        <p>コメント: <textarea name="comment"></textarea></p>
        <p>商品画像:  <input type="file" name="image" accept="image/*"></p>
        
    <button type="submit" style="background: orange;">新規登録</button>
    <a href="login.php"><button type="button" style="background: skyblue;">戻る</button></a>
    </form>
    </div>
</body>
</html>
