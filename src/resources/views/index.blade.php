@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content-header">
        <h1 class="content-title">商品一覧</h1>
        <div class="content-add">
            <a class="content-add_link" href="{{route('register')}}">+商品を追加</a>
        </div>
    </div>
    <div class="content-main">
        <aside class="search">
            <form class="search-form" action="{{ route('search') }}" method="get">
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
                        <option value="asc">安い順に表示</option>
                        <option value="desc">高い順に表示</option>
                    </select>
                </div>
            </form>
        </aside>
        <div class="content-item">
            <div class="contetn-cards">
                @foreach($products as $product)
                    <div class="content-card">
                        <a class="content-card__link" href="{{ route('show', ['id' =>  $product->id]) }}">
                            <div class="content-card__img">
                                <img src="{{ asset('storage/img/fruit-img/' . $product->image) }}" alt="">
                            </div>
                            <div class="content-card__txt">
                                <p>{{ $product->name }}</p>
                                <p>¥{{ $product->price }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </div>
</div>
@endsection