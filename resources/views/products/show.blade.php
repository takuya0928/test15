@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品情報詳細画面</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>商品名</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>メーカー</th>
            <td>{{ $product->maker }}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ $product->price }}</td>
        </tr>
        <tr>
            <th>在庫数</th>
            <td>{{ $product->stock }}</td>
        </tr>
        <tr>
            <th>コメント</th>
            <td>{{ $product->comment }}</td>
        </tr>
        <tr>
            <th>画像</th>
            <td>
                @if ($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" width="180" alt="">
                @else
                画像なし
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">編集</a>
    <a href="{{ route('products.index') }}" class="btn btn-secondary ">戻る</a>
</div>
@endsection