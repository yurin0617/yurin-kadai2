@extends('layouts.app')

@section('content')
<h1>商品詳細</h1>

<form action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    {{-- 更新なので本来は @method('PATCH') ですが、要件のパスが /update なので POST/PUT等で調整 --}}
    <div>
        <label>商品名</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>値段</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}">
        @error('price')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>商品画像</label><br>
        {{-- 現在の画像を表示 --}}
        <img src="{{ asset('storage/' . $product->image) }}" width="200"><br>
        <input type="file" name="image">
        @error('image') <div style="color: red;">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>季節</label>
        @foreach($seasons as $season)
        <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
            {{-- 
                   1. バリデーションエラーで戻った時 (old)
                   2. 初回表示時 (DBに保存されているか)
                   どちらかに該当すれば checked をつける
                --}}
            {{ (is_array(old('seasons')) && in_array($season->id, old('seasons'))) ||
                   ($product->seasons->contains($season->id)) ? 'checked' : '' }}>
        {{ $season->name }}
        @endforeach
        @error('seasons')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>商品説明</label>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
        @error('description')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">変更を保存</button>
    <a href="{{ route('products.index')}}">戻る</a>

    <hr> {{-- 区切り線 --}}
</form>

<form action="{{ route('products.destroy', ['productId' => $product->id]) }}" method="POST">
    @csrf
    {{-- ボタンのデザインはCSSで調整してください --}}
    <button type="submit" style="background-color: #999; color: white; padding: 5px 15px; border: none; cursor: pointer;">
        削除する
    </button>
</form>
@endsection