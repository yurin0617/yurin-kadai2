@extends('layouts.app')

@section('content')
<div class="index-container">
    <aside class="sidebar">
        <h2 class="sidebar-title">商品一覧</h2>

        <form action="{{ route('products.index') }}" method="GET" class="search-form">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="商品名で検索">

            <button type="submit">検索</button>

            <h3 class="sidebar-title">価格順で表示</h3>
            <select name="sort">
                <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>価格で並び替え</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
            </select>

        </form>
    </aside>

    <main class="main-content">
        <div class="top-actions">
            <a href="{{ route('product.register') }}" class="btn-add">+ 商品を追加</a>
        </div>

        <div class="product-grid">
            @foreach($products as $product)
            <a href="{{ route('products.show', ['productId' => $product->id]) }}" class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <div class="card-body">
                    <p><strong>{{ $product->name }}</strong></p>
                    <p>¥{{ number_format($product->price) }}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $products->appends(request()->query())->links()}}
        </div>
    </main>
</div>
@endsection