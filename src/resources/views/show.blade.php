@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="content">
    <form class="form" action="{{ route('update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="product">
            <p class="product-route">
                商品一覧<span>>{{ $product->name }}</span>
            </p>
            <div class="product-detail">
                <div class="product-img">
                    <img src="{{ asset('storage/app/public/img/fruit-img/' . $product->image) }}">
                    <input type="file" name="image"
                        value="{{ asset('storage/app/public/img/fruit-img/' . $product->image) }}">
                </div>
                <div class="form-error">
                    @error('img')
                        {{ $message }}
                    @enderror
                </div>
                <div class="product-txt">
                    <div class="product-input__txt">
                        <P class="input-label">商品名</P>
                        <input type="text" name="name" value="{{ $product->name }}" placeholder="商品名を入力">
                    </div>
                    <div class="form-error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="product-input__txt">
                        <p class="input-label">値段</p>
                        <input type="text" name="price" value="{{ $product->price }}" placeholder="値段を入力">
                    </div>
                    <div class="form-error">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="product-input__txt">
                        <p class="input-label">季節</p>
                        <div class="product-input__check-box">
                            <input type="checkbox" name="season_id[]" value="1">春
                            <input type="checkbox" name="season_id[]" value="2">夏
                            <input type="checkbox" name="season_id[]" value="3">秋
                            <input type="checkbox" name="season_id[]" value="4">冬
                        </div>
                        <div class="form-error">
                            @error('check')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="product-description">
                        <p class="input-label">商品説明</p>
                        <textarea name="description" value="{{ $product->description }}"
                            placeholder="商品説明を入力">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-error">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form-button">
            <a class="form-button__back" href="/products">戻る</a>
            <button class="form-button__submit" type="submit" value="submit">変更を保存</button>
        </div>
    </form>
    <form class="delete-form" action="/product/{productID}/delete" method="post">
        @csrf
        @method('delete')
        <div class="delete-button">
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input class="delete-button__submit" type="image" src="{{ asset('storage/app/public/img/trashbox.svg') }}">
        </div>
    </form>
</div>
@endsection