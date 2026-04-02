<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf

    <div>
        <label>商品名</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>値段</label>
        <input type="number" name="price" value="{{ old('price') }}">
        @error('price')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>商品画像</label>
        <input type="file" name="image">
        @error('image')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>季節</label>
        <input type="checkbox" name="seasons[]" value="1"> 春
        <input type="checkbox" name="seasons[]" value="2"> 夏
        <input type="checkbox" name="seasons[]" value="3"> 秋
        <input type="checkbox" name="seasons[]" value="4"> 冬
        @error('seasons')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>商品説明</label>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">登録</button>
    <a href="{{ route('products.index') }}">戻る</a>
</form>