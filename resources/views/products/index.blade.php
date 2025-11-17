@extends('layouts.app')

@section('content')
<div class="container">
<h1>商品一覧画面</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- 検索フォーム -->
<div class="card mb-3 p-3">
    <div class="row g-2">
        <div class="col-md-3">
            <input type="text" id="keyword" class="form-control" placeholder="キーワードを入力">
        </div>
        <div class="col-md-2">
            <input type="number" id="price_min" class="form-control" placeholder="価格（下限）">
        </div>
        <div class="col-md-2">
            <input type="number" id="price_max" class="form-control" placeholder="価格（上限）">
        </div>
        <div class="col-md-2">
            <input type="number" id="stock_min" class="form-control" placeholder="在庫（下限）">
        </div>
        <div class="col-md-2">
            <input type="number" id="stock_max" class="form-control" placeholder="在庫（上限）">
        </div>
        <div class="col-md-1 d-grid">
            <button id="searchBtn" class="btn btn-primary">検索</button>
        </div>
    </div>
</div>

<a href="{{ route('products.create') }}" class="btn btn-success mb-3">新規登録</a>

<div id="product-table"
    data-search-url="{{ route('products.search') }}"
    data-delete-base-url="{{ url('products') }}">
    @include('products.partials.table')
</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/products.js') }}"></script>
@endpush