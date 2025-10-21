@extends('layouts.app')

@section('content')
<div class="container">
<h1>商品一覧画面</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-success">{{ session('error') }}</div>
@endif

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">新規登録</a>

<table class="table table-bordered">
<thead>
<tr>
<th>ID</th>
<th>商品名</th>
<th>メーカー</th>
<th>価格</th>
<th>在庫数</th>
<th>画像</th>
</tr>
</thead>
<tbody></tbody>
@forelse ($products as $product)
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
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">詳細</a>
    <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>

</td>
</tr>
@empty
<tr><td colspan="5">商品がありません。</td></tr>
@endforelse
</tbody>
</table>
</div>
@endsection