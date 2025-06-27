<!-- register-user.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ユーザー新規登録</title>
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
    <h2>ユーザー新規登録画面</h2>
    <form action="register-user-done.php" method="post">
        <label for="">アドレス：</label><br>
        <input type="email" name="email" required><br><br>

        <label for="">パスワード：</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" class="button register">登録する</button>

        <a href="index.php" class="button login">戻る</a>
        




    </form>
</body>
</html>