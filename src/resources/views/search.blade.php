@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content-header">
        <h1>"{{ $keyword }}"の商品一覧</h1>
    </div>
    <div class="content-main">
        <aside class="search">
            <form class="search-form" action="{{ route('search') }}" method="post">
                @csrf
                <div class="search-form__group">
                    <div class="search-form__item">
                        <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}"
                            placeholder="商品名で検索">
                    </div>
                    <button class="search-form__button" type="submit">検索</button>
                </div>
                <h2>価格順で表示</h2>
                <div class="sort-options">
                    <select class="sort-select" name="sort">
                        <option value="">価格で並べ替え</option>
                        <option value="asc">高い順に表示</option>
                        <option value="desc">安い順に表示</option>
                    </select>
                </div>
            </form>
        </aside>
        <div class="content-item">
            <div class="contetn-cards">
                @foreach($products as $product)
                    <div class="content-card">
                        <a class="content-card__link" href="{{ route('show', ['productId' => $product->id]) }}">
                            <div class="content-card__img">
                                <img src="{{ asset('storage/fruits-img' . $product->image) }}" alt="">
                            </div>
                            <div class="content-card__txt">
                                <p>{{ $product->name }}</p>
                                <p>¥{{ $product->price }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection