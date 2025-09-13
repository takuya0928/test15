@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品情報編集画面</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label>商品名*</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
    </div>
    <div class="form-group mb-3">
        <label>メーカー名*</label>
        <input type="text" name="maker" class="form-control" value="{{ old('maker', $product->maker) }}" required>
    </div>
    <div class="form-group mb-3">
        <label>価格*</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
    </div>
    <div class="form-group mb-3">
        <label>在庫数*</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
    </div>
    <div class="form-group mb-3">
        <label>コメント*</label>
        <textarea name="comment" class="form-control">{{ old('comment', $product->comment) }}</textarea>
    </div>
    <div class="form-group mb-3">
        <label>商品画像</label><br>
        @if ($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}" width="120"  class="mb-2" alt=""><br>
        @endif
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">更新する</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
</form>
</div>
@endsection