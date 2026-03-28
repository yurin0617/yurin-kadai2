<h1>商品一覧</h1>

<ul>
    @foreach($products as $product)
    <li>
        <img src="{{ asset('storage/' . $product->image) }}" width="100">
        {{ $product->name }}（{{ $product->price }}円）
        <br>
        季節：
        @foreach($product->seasons as $season)
        {{ $season->name }}
        @endforeach
    </li>
    <hr>
    @endforeach
</ul>