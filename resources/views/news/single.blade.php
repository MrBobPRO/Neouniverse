@extends('layouts.app')

@section('main')
<main class="main single-news" id="main" role="main">
    {{-- Breadcrumbs start --}}
    <section class="breadcrumbs">
        <div class="breadcrumbs__inner main-container">
            <ul class="breadcrumbs__ul">
                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('home') }}">{{ __('Главная') }}</a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('news.index') }}">{{ __('Новости') }}</a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link">
                        @foreach ($new->categories as $category)
                            @if ($loop->last)
                                {{ $category[$locale . '_name']}}
                            @else
                                {{ $category
                                [$locale . '_name']}} /
                            @endif
                        @endforeach
                    </a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('news.single', $new->url) }}">{{ $new[$locale . '_title']}}</a>
                </li>
            </ul>
        </div>
    </section> {{-- Breadcrumbs end --}}

    {{-- News content start --}}
    <section class="news-content">
        <div class="news-content__inner main-container">
            <h1 class="news-content__title main-title">{{ $new[$locale . '_title']}}</h1>
            <img class="news-content__image" src="{{ asset('img/news/' . $new[$locale . '_image']) }}" alt="{{ $new[$locale . '_title'] }}">
            <div class="news-content__body">
                {!! $new[$locale . '_body'] !!}
            </div>
        </div>
    </section> {{-- News content end --}}

    {{-- Similar products start --}}
    @if(count($similar_news))
        <section class="similar-news">
            <div class="similar-news__inner main-container">
                <div class="title_with_explore_more similar-news__title">
                    <h1 class="main-title">{{ __('Похожие новости') }}</h1>
                    <a href="{{ route('news.index') }}">{{ __('Все новости') }} <span class="material-icons-outlined">arrow_forward</span></a>
                </div>

                <x-news.list :news="$similar_news"/>
            </div>
        </section>
    @endif {{-- Similar products end --}}

</main>
@endsection