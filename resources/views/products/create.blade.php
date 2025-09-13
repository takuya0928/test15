@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品新規登録</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="">商品名*</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="">メーカー名*</label>
            <input type="text" name="maker" class="form-control" value="{{ old('maker') }}" required>
        </div>
        <div class="mb-3">
            <label for="">価格*</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>
        <div class="mb-3">
            <label for="">在庫数*</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
        </div>
        <div class="mb-3">
            <label for="">コメント</label>
            <textarea name="comment" class="form-control">{{ old('comment') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="">商品画像</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">登録する</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection