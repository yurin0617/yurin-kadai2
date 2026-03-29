<h1>商品一覧</h1>
<div class="registration-link">
    <a href="{{ route('product.register') }}" class="btn-add">+ 商品を追加</a>
</div>
<div class="search-container">
    <form action="{{ route('products.index') }}" method="GET" id="searchForm">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="商品名で検索">

        <select name="sort">
            <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>価格で並び替え</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
        </select>

        <button type="submit">検索</button>
    </form>

    @if(request('sort'))
    <div class="sort-tag-modal">
        <span>
            {{ request('sort') == 'asc' ? '低い順に表示' : '高い順に表示' }}
        </span>
        <a href="{{ route('products.index', ['search' => request('search')]) }}">×</a>
    </div>
    @endif
</div>

<div class="product-grid">
    @foreach($products as $product)
    <a href="{{ route('products.show', ['productId' => $product->id]) }}" class="product-card">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        <p>{{ $product->name }}</p>
        <p>¥{{ number_format($product->price) }}</p>
    </a>
    @endforeach
</div>

{{ $products->appends(request()->query())->links() }}