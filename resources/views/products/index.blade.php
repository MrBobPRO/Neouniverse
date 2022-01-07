@extends('layouts.app')

@section('main')
<main class="main products" id="main" role="main">
    <x-main-carousel/>
    {{-- Products text start --}}
    <section class="products__text">
        <div class="products__text-inner main-container">
            <div class="about-products">
                <h1 class="about-products__title main-title">{{ __('О нашей продукции') }}</h1>
    
                <div class=about-products__text">
                    @php $aboutProducts = App\Models\Option::where('tag', 'about-products')->first(); @endphp
                    {{ $aboutProducts[$localedValue] }}
                </div>
            </div>

            <div class="products-warning">
                <h1 class="products-warning__title main-title">{{ __('Внимание') }}</h1>
    
                <div class="products-warning__text">
                    @php $productsWarning = App\Models\Option::where('tag', 'products-warning')->first(); @endphp
                    {{ $productsWarning[$localedValue] }}
                </div>
            </div>
        </div>
    </section> {{-- Products text end --}}

    <section class="all-products">
        <div class="all-products__inner main-container">
            <h1 class="all-products__title main-title">{{ __('О нашей продукции') }} <span>92 продукта</span></h1>
        </div>
    </section>

</main>

@endsection