<h1>商品詳細</h1>

<div>
    <img src="{{ asset('storage/' . $product->image) }}" width="300">
</div>

<h2>{{ $product->name }}</h2>
<p>価格：{{ $product->price }}円</p>

<h3>季節</h3>
<p>
    @foreach($product->seasons as $season)
    {{ $season->name }}
    @endforeach
</p>

<h3>商品説明</h3>
<p>{{ $product->description }}</p>

<a href="{{ route('products.index') }}">一覧に戻る</a>