@props(['products'])

<div class="products-carousel-container">
    <div class="owl-carousel products-carousel" id="products_carousel">
        @foreach ($products as $product)
            <div class="products-carousel__item products-card">
                <a href="#" class="products-card__image-container">
                    <img class="products-card__image" src="{{ asset('img/products/thumbs/' . $product->image) }}" alt="{{ $product->name }}">
                    <span class="products-card__prescription {{ $product->prescription ? 'products-card__prescription--rx' : 'products-card__prescription--otc' }}">{{ $product->prescription ? 'RX' : 'OTC' }}</span>
                </a>
                <h2 class="products-card__title">{{ $product->name }}</h2>
                <div class="products-card__categories">
                    <a href="#">Витамины и минералы</a>
                </div>
                <div class="products-card__description">{!! $product->description !!}</div>
            </div>
        @endforeach
    </div>
    
    <span class="material-icons-outlined unselectable owl-nav owl-nav--prev products-carousel__owl-nav--prev">arrow_back_ios</span>
    <span class="material-icons-outlined unselectable owl-nav owl-nav--next products-carousel__owl-nav--next">arrow_forward_ios</span>
</div>
