@extends('layouts.app')

@section('content')
<div class="detail-container">
    <h2 class="page-title">商品詳細・更新</h2>

    {{-- 更新フォーム --}}
    <form action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data" class="detail-form" novalidate>
        @csrf
        {{-- 上段：横並びエリア --}}
        <div class="detail-flex-row">
            {{-- 左側：画像 --}}
            <div class="detail-image-group">
                <div class="current-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
                <div class="file-upload">
                    <input type="file" name="image" class="file-input">
                </div>
                @error('image') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- 右側：基本情報 --}}
            <div class="detail-info-group">
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}">
                    @error('name') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>値段</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}">
                    @error('price') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>季節</label>
                    <div class="checkbox-group">
                        @foreach($seasons as $season)
                        <label>
                            <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                {{ (is_array(old('seasons')) && in_array($season->id, old('seasons'))) ||
                                ($product->seasons->contains($season->id)) ? 'checked' : '' }}>
                            {{ $season->name }}
                        </label>
                        @endforeach
                    </div>
                    @error('seasons') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        {{-- 下段：商品説明 --}}
        <div class="form-group description-area">
            <label>商品説明</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
            @error('description') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        {{-- 下段：ボタン --}}
        <div class="form-actions">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">変更を保存</button>
        </div>
    </form>

    <hr class="divider">

    {{-- 削除フォーム --}}
    <form action="{{ route('products.destroy', ['productId' => $product->id]) }}" method="POST" class="delete-form" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        <button type="submit" class="btn-delete">この商品を削除する</button>
    </form>
</div>
@endsection