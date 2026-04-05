@extends('layouts.app')

@section('content')
<div class="register-container">
    <h2 class="page-title">商品登録</h2>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="register-form" novalidate>
        @csrf

        {{-- 商品名 --}}
        <div class="form-group">
            <label>商品名 <span class="required">必須</span></label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
            @error('name')
            <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        {{-- 値段 --}}
        <div class="form-group">
            <label>値段 <span class="required">必須</span></label>
            <input type="number" name="price" value="{{ old('price') }}" placeholder="値段を入力">
            @error('price')
            <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        {{-- 商品画像 --}}
        <div class="form-group">
            <label>商品画像 <span class="required">必須</span></label>
            <input type="file" name="image" class="file-input">
            @error('image')
            <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        {{-- 季節 --}}
        <div class="form-group">
            <label>季節 <span class="required">必須</span></label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="seasons[]" value="1" {{ is_array(old('seasons')) && in_array('1', old('seasons')) ? 'checked' : '' }}> 春</label>
                <label><input type="checkbox" name="seasons[]" value="2" {{ is_array(old('seasons')) && in_array('2', old('seasons')) ? 'checked' : '' }}> 夏</label>
                <label><input type="checkbox" name="seasons[]" value="3" {{ is_array(old('seasons')) && in_array('3', old('seasons')) ? 'checked' : '' }}> 秋</label>
                <label><input type="checkbox" name="seasons[]" value="4" {{ is_array(old('seasons')) && in_array('4', old('seasons')) ? 'checked' : '' }}> 冬</label>
            </div>
            @error('seasons')
            <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        {{-- 商品説明 --}}
        <div class="form-group">
            <label>商品説明 <span class="required">必須</span></label>
            <textarea name="description" placeholder="商品の説明を入力してください">{{ old('description') }}</textarea>
            @error('description')
            <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        {{-- ボタンエリア --}}
        <div class="form-actions">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">登録</button>
        </div>
    </form>
</div>
@endsection