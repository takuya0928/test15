@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">ダッシュボード</h2>

    <p>ログインしました</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">商品一覧へ</a>
</div>
@endsection