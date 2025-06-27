<!-- 新規登録ページ -->
<?php
require_once 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $maker = $_POST['maker'] ?? '';
    $image_path = $_POST['image_path'] ?? '';

    if ($name && $price && $stock && $maker && !$error){
        $stmt = $pdo->prepare("INSERT INTO products (name, price, stock, maker, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $price, $stock, $maker, $image_path]);
        header("Location: login.php");
        exit;
    } else {
        if (!$error) $error = "必要項目を入力してください。";
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
    <form action="store.php" method="post" enctype="multipart/form-data">
        <p>商品名*: <input type="text" name="name" required></p>
        <p>メーカー名*: <input type="text" name="maker"></p>
        <p>価格*: <input type="number" name="price"></p>
        <p>在庫数*: <input type="number" name="stock"></p>
        <p>コメント: <textarea name="comment"></textarea></p>
        <p>商品画像:  <input type="text" name="image_path" placeholder="images/xxx.jpg"></p>
        
    <button type="submit" style="background: orange;">新規登録</button>
    <a href="login.php"><button type="button" style="background: skyblue;">戻る</button></a>
    </form>
    </div>
</body>
</html>
