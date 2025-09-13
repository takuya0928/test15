@extends('layouts.app')

@section('content')
<div class="container">
<h1>商品一覧画面</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

<form action="{{ route('products.index') }}" method="GET" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="keyword" class="form-control" placeholder="検索キーワード" value="{{ request('keyword') }}">
    </div>
    <div class="col-md-4">
        <input type="text" name="maker" class="form-control" placeholder="メーカー名" value="{{ request('maker') }}">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">検索</button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('products.index') }}" class="btn btn-secondary w-100">リセット</a>
    </div>
</form>

<a href="{{ route('products.create') }}" class="btn btn-warning mb-3">新規登録</a>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>商品名</th>
<th>メーカー</th>
<th>価格</th>
<th>在庫数</th>
<th>画像</th>
</tr>
@foreach ($products as $product)
<tr>
<td>{{ $product->id }}</td>
<td>{{ $product->name }}</td>
<td>{{ $product->maker }}</td>
<td>{{ $product->price }}</td>
<td>{{ $product->stock }}</td>
<td>
    @if ($product->image_path)
    <img src="{{ asset('storage/' . $product->image_path) }}" width="80" alt="商品画像">
    @else
    画像なし
    @endif
</td>
<td>
    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">詳細</a>
    <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>

</td>
</tr>
@endforeach
</table>
<div class="d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-4') }}
</div>
</div>
@endsection