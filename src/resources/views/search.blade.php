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
            <form class="search-form" action="{{ route('search') }}" method="get">
                @csrf
                <div class="search-form__group">
                    <div class="search-form__item">
                        <input class="search-form__item-input" type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="商品名で検索">
                    </div>
                    <button class="search-form__button" type="submit">検索</button>
                </div>
                <h2>価格順で表示</h2>
                <div class="sort-options">
                    <select class="sort-select" name="sort">
                        <option value="asc" {{ request('sort') == 'asc' ? 'selcted' : '' }}>安い順に表示</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                    </select>
                </div>
            </form>
            @if(@isset($sort)&& $sort != "")
                <div class="sort-contents">
                    <p class="searched_data">{{$sort == 'asc' ? '安い順に表示' : ($sort == 'desc' ? '高い順に表示' : '')}}</p>
                    <div class="close-content">
                        <a href="/products">
                            <img src="{{ asset('storage/img/close.png') }}" alt="閉じるアイコン" class="img-close-icon"/>
                        </a>
                    </div>
                </div>
            @endif
        </aside>
        <div class="content-item">
            <div class="contetn-cards">
                @foreach($products as $product)
                    <div class="content-card">
                        <a class="content-card__link" href="{{ route('show', ['id' => $product->id]) }}">
                            <div class="content-card__img">
                                <img src="{{ url('storage/img/fruit-img/' . $product->image) }}?v={{ time() }}" alt="{{ $product->name}}">
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