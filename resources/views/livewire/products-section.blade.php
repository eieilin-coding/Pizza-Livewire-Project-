 <section class="products section" id="products">
    <h2 class="section__title">The Most <br> Devoured Pizzas</h2>
    <div class="products__container container grid">
        @foreach($pizzaProducts as $product)
        <article class="products__card">
            <img src="{{asset('storage/'. $product->image) }}" alt="image" class="products__img">
            <h3 class="products__name">{{ $product->name }} <br> Pizza </h3>
            {{-- <span class="products__price">${{ number_format($product->price, 2) }}</span> --}}
            <button class="products__button">
                <i class="ri-shopping-bag-3-fill"></i>
            </button>
        </article>  
        @endforeach     
    </div>
</section>

