<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if ($errors->any())
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div>
        <label>商品名</label>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        <label>値段</label>
        <input type="number" name="price" value="{{ old('price') }}">
    </div>

    <div>
        <label>商品画像</label>
        <input type="file" name="image">
    </div>

    <div>
        <label>季節</label>
        <input type="checkbox" name="seasons[]" value="1"> 春
        <input type="checkbox" name="seasons[]" value="2"> 夏
        <input type="checkbox" name="seasons[]" value="3"> 秋
        <input type="checkbox" name="seasons[]" value="4"> 冬
    </div>

    <div>
        <label>商品説明</label>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <button type="submit">登録</button>
    <a href="{{ route('products.index') }}">戻る</a>
</form>