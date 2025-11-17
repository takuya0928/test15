<table class="table table-bordered">
    <thead>
        <tr>
            <th class="sortable" data-column="id">ID</th>
            <th class="sortable" data-column="name">商品名</th>
            <th class="sortable" data-column="maker">メーカー</th>
            <th class="sortable" data-column="price">価格</th>
            <th class="sortable" data-column="stock">在庫数</th>
            <th>画像</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr id="product-{{ $product->id }}">
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
                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $product->id }}">削除</button>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center">商品がありません。</td></tr>
        @endforelse
    </tbody>
</table>