<!-- 登録処理画面 -->


<?php

require_once 'models/ProductModel.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


// 入力を取得・初期化
    $name = $_POST['name'] ?? '';
    $maker = $_POST['maker'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $comment = $_POST['comment'] ?? '';
    $image_path = $_POST['image_path'] ??'';

    // 入力チェック
    if ($name === '' || $maker === '' || $price === '' || $stock === '') {
        exit('必要な項目が入力されていません。');
    }
    if (!is_numeric($price) || !is_numeric($stock)) {
        exit('価格と在庫数は数値で入力してください。');
    }
    

    // 型を明確に変換
    $price = (int)$price;
    $stock = (int)$stock;

    // モデルのcreateメッゾトを呼び出す（image_pathは今回空）
    ProductModel::create($name, $maker, $price, $stock, $comment, null);

// 完了後にリダイレクト
header("Location: login.php");
exit;
