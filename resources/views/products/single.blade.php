@extends('layouts.app')

@section('main')
<main class="main single-product" id="main" role="main">
    <section class="main-container single-product__inner">
        <div class="breadcrumbs">
            <ul class="breadcrumbs__ul">
                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('home') }}">Главная</a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('home') }}">Продукты</a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('home') }}">Аллергология</a>
                </li>

                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link" href="{{ route('home') }}">Амброксол</a>
                </li>
            </ul>
        </div>
    </section>

</main>
@endsection