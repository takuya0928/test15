<?php require 'db.php';
// DB接続ファイルを読み込み

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// 安全にハッシュ化

try {
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?,?)");
    $stmt->execute([$email, $password]);
    echo "<p>登録が完了しました。</p>";
    echo '<a href="index.php">ログイン画面へ</a>';
} catch (PDOException $e) {
    echo "エラー： " . $e->getMessage();
}