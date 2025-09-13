@extends('layouts.app')

@section('content')

<div class="login-wrapper">
    <div class="login-card">
        <h1 class="login-title">ユーザーログイン画像</h1>
        <!-- エラーメッセージ -->
        @if ($errors->any())
        <div class="error-massages">
                <ul >
                    @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
        @endif

        <!-- ログインフォーム -->
        <form action="{{ url('login') }}" method="POST" class="login-form">
            @csrf
                <div class="form-group">
                    <input type="email" name="email" id="email" 
                    placeholder="アドレス" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="email" 
                    placeholder="パスワード" required>
                </div>
                <div class="button-group">
                    <a href="{{ route('register') }}" class="btn btn-register">新規登録</a>
                    <button type="submit" class="btn btn-login">ログイン</button>
                </div>
        </form>
    </div>
</div>
@endsection