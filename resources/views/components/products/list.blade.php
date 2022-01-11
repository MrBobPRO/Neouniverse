<div class="products-list" id="products_list">
    @foreach ($products as $product)
        <x-products.card :product="$product" />
    @endforeach
</div>

{{ $products->links('layouts.pagination') }}