
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <title>商品管理システム</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('products.index') }}">商品一覧</a>
            @auth
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
            @endauth
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>

</body>
</html>