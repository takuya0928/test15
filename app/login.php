<!-- 商品一覧画面 -->

<?php

require_once 'models/ProductModel.php';

$keyword = $_GET['keyword'] ?? '';
$maker = $_GET['maker'] ?? '';

$sql = "SELECT * FROM products WHERE 1";
$params = [];

if ($keyword !=='') {
    $sql .= " AND name LIKE ?";
    $params[] = "%$keyword%";
}

if ($maker !=='') {
    $sql .= " AND maker = ?";
    $params[] = $maker;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>商品一覧画面</h1>
    
    <form method="get" action="">
        <input type="text" name="keyword" placeholder="検索キーワード">
        <select name="maker" id="">
            <option value="">メーカー名</option>
            <option value="Coca-Cola">Coca-Cola</option>
            <option value="サントリー">サントリー</option>
            <option value="キリン">キリン</option>
        </select>
        <button type="submit">検索</button>
    </form>


    <table border="1">
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th><a href="create.php">新規登録</a></th>
        </tr>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['id']) ?></td>
                <td><img src="<?= htmlspecialchars($p['image_path']) ?>" width="50" alt=""></td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td>￥<?= htmlspecialchars($p['price']) ?></td>
                <td><?= htmlspecialchars($p['stock']) ?></td>
                <td><?= htmlspecialchars($p['maker']) ?></td>
                <td><a href="detail.php?id=<?= $p['id'] ?>">詳細</a></td>
                <td><a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('削除しますか？')">削除</a></td>
            </tr>
            <?php endforeach; ?>
    </table>
    </div>


</body>
</html>