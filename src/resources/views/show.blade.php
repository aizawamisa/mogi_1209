@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="content">
    <form class="form" action="{{ route('update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="product">
            <p class="product-route">
                商品一覧<span>>{{ $product->name }}</span>
            </p>
            <div class="product-detail">
                <div class="product-img">
                    <img id="preview-image" src="{{ url('storage/img/fruit-img/' . $product->image) }}?v={{ time() }}" alt="{{ $product->name }}" style="max-width: 300px; max-height: 300px;">
                    <input id="image-upload" type="file" name="image" style="display:none;" accept="image/*">
                    <label for="image-upload" class="custom-file-upload">ファイルを選択</label>
                    <span id="file-name">{{ $product->image }}</span>
                    <!-- <input type="file" name="image"
                        value="{{ url('storag/img/fruit-img/' . $product->image) }}"> -->
                </div>
                <div class="form-error">
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>
                <div class="product-txt">
                    <div class="product-input__txt">
                        <P class="input-label">商品名</P>
                        <input type="text" name="name" value="{{ old('name',$product->name) }}" placeholder="商品名を入力">
                    </div>
                    <div class="form-error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="product-input__txt">
                        <p class="input-label">値段</p>
                        <input type="text" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                    </div>
                    <div class="form-error">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="product-input__txt">
                        <p class="input-label">季節</p>
                        <div class="product-input__check-box">
                            @foreach ($allSeasons as $season)
                                <input type="checkbox" name="season_id[]" value="{{ $season->id }}" @if (in_array($season->id, old('season_id', $product->seasons->pluck('id')->toArray()))) checked @endif>
                                {{ $season->name }}
                            @endforeach
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
                            placeholder="商品説明を入力">{{ old('description',$product->description) }}</textarea>
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
    <form class="delete-form" action="{{ route('destroy', $product->id)}}" method="post">
        @csrf
        @method('delete')
        <div class="delete-button">
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input class="delete-button__submit" type="image" src="{{ asset('storage/img/trashbox.png') }}">
        </div>
    </form>
</div>

<script>
    document.getElementById('image-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const fileNameDisplay = document.getElementById('file-name');
        const imagePreview = document.getElementById('preview-image');

        fileNameDisplay.textContent = file ? file.name : '選択されていません';

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection