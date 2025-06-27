<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザーログイン画面</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        input {
            display: block;
            margin: 10px auto;
            padding: 10px;
            width: 300px;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            color: white;
        }
        .register {
            background-color: orange;
        }
        .login {
            background-color: turquoise;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>ユーザーログイン画面</h2>

    <form action="login.php" method="post">
        <input type="text" name="address" placeholder="アドレス">
        <input type="password" name="password" placeholder="パスワード">
        
        <div>
            <a href="register-user.php" class="button register">新規登録</a>
            <button type="submit" class="button login">ログイン</button>
        </div>
    </form>
    </div>
</body>
</html>