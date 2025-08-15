<section class="popular section" id="popular">
    <div class="popular__container container grid">
        <div class="popular__data">
            <h2 class="section__title">Discover <br> Popular Orders</h2>
            <p class="popular__description">
                Select the best prepared and delicious flavors.
                We have collected some popular recipes from around
                the world for you to choose your favorite.
            </p>
        </div>
        <div class="popular__swiper swiper">
            <img src="{{ asset('storage/photos/popular-dish.png') }}" alt="image" class="popular__dish">
            <div class="swiper-wrapper">
                <article class="popular__card swiper-slide">
                    <img src="{{ asset('storage/photos/popular-1.png') }}" alt="image" class="popular__img">
                    <h3 class="popular__title">Margherita Pizza</h3>
                </article>

                <article class="popular__card swiper-slide">
                    <img src="{{ asset('storage/photos/popular-2.png') }}" alt="image" class="popular__img">
                    <h3 class="popular__title">Mushroom Pizza</h3>
                </article>

                <article class="popular__card swiper-slide">
                    <img src="{{ asset('storage/photos/popular-3.png') }}" alt="image" class="popular__img">
                    <h3 class="popular__title">Pepperoni Pizza</h3>
                </article>
            </div>
        </div>
    </div>
</section>