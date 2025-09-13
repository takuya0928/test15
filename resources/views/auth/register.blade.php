@extends('layouts.app')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <h1 class="login-title">ユーザー新規登録画像</h1>

        <!-- エラーメッセージ -->
        @if ($errors->any())
        <div class="error-massages">
                <ul >
                    @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
        @endif

        <!-- 新規登録フォーム -->
        <form action="{{ url('register') }}" method="POST" class="login-form">
            @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="パスワード"  required>
        </div>
        
        <div class="button-group">
                    <a href="{{ route('login') }}" class="btn btn-login">ログインへ戻る</a>
                    <button type="submit" class="btn btn-register">登録</button>
        </div>
        </form>
    </div>
</div>
@endsection