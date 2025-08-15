<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    {{-- <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon"> --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">


    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

    <!--=============== SWIPER CSS ===============-->
    {{-- <link rel="stylesheet" href="assets/css/swiper-bundle.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <!--=============== CSS ===============-->

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/wishlist.css') }}">

    <!--=============== Wishlist CSRF Token ===============-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Responsive Bakery website - Bedimcode</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="{{ route('products.index') }}" class="nav__logo">
                <i class="ri-book-3-line"></i><span id="nav__brand">Bakery</span>
            </a>
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">
                            <i class="ri-home-4-line"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#featured" class="nav__link">
                            <i class="ri-book-3-line"></i>
                            <span>Cakes</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#discount" class="nav__link">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Discount</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#new" class="nav__link">
                            <i class="ri-bookmark-line"></i>
                            <span>Pastries</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#testimonial" class="nav__link">
                            <i class="ri-message-3-line"></i>
                            <span>Testimonial</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="nav__actions">
                <!-- Search button -->
                <i class="ri-search-line search-button" id="search-button"></i>
                @auth
                    @php
                        $user = auth()->user();
                    @endphp

                    @if ($user->hasRole(['Admin', 'Super Admin']))
                        <a href="{{ route('dashboard') }}" title="Admin Dashboard">
                            <i class="ri-dashboard-line"></i>
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; cursor: pointer;">
                            <i class="ri-logout-box-r-line" title="Logout"></i>
                        </button>
                    </form>
                @else
                    <a wire:navigate href="{{ route('login') }}" class="login-button">
                        <i class="ri-login-circle-line"></i>
                    </a>
                    <a wire:navigate href="{{ route('register') }}" class="register-button">
                        <i class="ri-user-line"></i>
                    </a>
                @endauth


                <!-- Theme button -->
                <i class="ri-moon-line change-theme" id="theme-button"></i>
            </div>

        </nav>
    </header>

    <!--==================== SEARCH ====================-->
    <div class="search" id="search-content">
        <form action="#" method="GET" class="search__form">
            <i class="ri-search-line search__icon"></i>
            <input type="search" name="search" placeholder="What are you looking for?" class="search__input"
                value="{{ request('search') }}" onkeydown="if(event.key === 'Enter') this.form.submit()">
        </form>
        <i class="ri-close-line search__close" id="search-close"></i>
    </div>

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <div class="home__data">
                    <h1 class="home__title">
                        Browse & <br>
                        Select Cakes
                    </h1>
                    <p class="home__description">
                        Find the best e-books from your favorite
                        writers, explore hundreds of books with all
                        possible categories, take advantage of the
                        50% discount and much more.
                    </p>

                    <a href="#" class="button">Explore Now</a>
                </div>
                <div class="home__images">
                    <div class="home__swiper swiper">
                        <div class="swiper-wrapper">
                            <article class="home__article swiper-slide">
                                <img src="{{ asset('storage/photos/machaCake.jpg') }}" alt="image"
                                    class="home__img">
                            </article>

                            <article class="home__article swiper-slide">
                                <img src="{{ asset('storage/photos/bberyCake.jpg') }}" alt="image"
                                    class="home__img">
                            </article>

                            <article class="home__article swiper-slide">
                                <img src="{{ asset('storage/photos/cupcake4.jpg') }}" alt="image"
                                    class="home__img">
                            </article>

                            <article class="home__article swiper-slide">
                                <img src="{{ asset('storage/photos/cookie5.jpg') }}" alt="image"
                                    class="home__img">
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--==================== SERVICES ====================-->
        <section class="services section">
            <div class="services__container container grid">
                <article class="services__card">
                    <i class="ri-truck-line"></i>
                    <h3 class="services__title">Free Shipping</h3>
                    <p class="services__description">Order More Than $100</p>
                </article>

                <article class="services__card">
                    <i class="ri-lock-line"></i>
                    <h3 class="services__title">Secure Payment</h3>
                    <p class="services__description">100% Secure Payment</p>
                </article>

                <article class="services__card">
                    <i class="ri-customer-service-line"></i>
                    <h3 class="services__title">24/7 Support</h3>
                    <p class="services__description">Call us anytime</p>
                </article>

            </div>
        </section>

        <!--==================== FEATURED ====================-->
        <section class="featured section" id="featured">
            <h2 class="section__title">
                Delicious Cakes
            </h2>
            <div class="featured__container container">
                <div class="featured__swiper swiper">
                    <div class="swiper-wrapper">
                        @foreach ($cakeProducts as $book)
                            <article class="featured__card swiper-slide">
                                @if ($book->image)
                                    <img src=" {{ asset('storage/' . $book->image) }}" alt="image"
                                        class="featured__img">
                                @endif
                                <h2 class="featured__title">{{ $book->name }}</h2>
                                {{-- <h2 class="featured__title">Featured Book</h2> --}}
                                <div class="featured__prices">
                                    <span class="featured__discount">${{ $book->price }}</span>
                                    {{-- <span class="featured__price">MMK{{ $book->normal_price }}</span> --}}
                                </div>
                                {{-- <button class="button">Add To Card</button> --}}
                                <div class="featured__actions">

                                    <button class="wishlist-btn" data-book-id="{{ $book->id }}"
                                        data-book-title="{{ $book->title }}">
                                        <i class="ri-heart-3-line"></i>
                                    </button>
                                    <a href="{{ url("/books/show/$book->id") }}"><i class="ri-eye-line"></i></a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <a href="#" class="see__more">See All Cakes >>> </a>
            </div>
        </section>

        <!--==================== DISCOUNT ====================-->
        <section class="discount section" id="discount">
            <div class="discount__container container grid">
                <div class="discount__data">
                    <h2 class="discount__title section__title">
                        Up To 50% discount
                    </h2>
                    <p class="discount__description">
                        Take advantage of the discount days we
                        have for you, buy books from your favorite
                        writers, the more you buy, the more
                        discounts we have for you.
                    </p>

                    <a href="#" class="button">Shop Now</a>
                </div>
                <div class="discount__images">
                    <img src=" {{ asset('storage/photos/icecream2.jpg') }}" alt="image" class="discount__img-1">
                    <img src="{{ asset('storage/photos/smootie.jpg') }}" alt="image" class="discount__img-2">
                </div>
            </div>
        </section>

        <!--==================== DISCOUNT ====================-->

        {{-- <section class="featured section" id="discount">
            <h2 class="section__title">
                Discount Books
            </h2>
            <div class="featured__container container">
                <div class="featured__swiper swiper">
                    <div class="swiper-wrapper">
                        @foreach ($discountBooks as $book)
                            <article class="featured__card swiper-slide">
                                @if ($book->photo)
                                    <img src=" {{ asset('storage/photos/' . $book->photo) }}" alt="image"
                                        class="featured__img">
                                @endif
                                <h2 class="featured__title">{{ $book->title }}</h2>
                                <div class="featured__prices">
                                    <span class="featured__discount">MMK{{ $book->disc_price }}</span>
                                    <span class="featured__price">MMK{{ $book->normal_price }}</span>
                                </div>
                                <div class="featured__actions"> --}}
        {{-- <button><i class="ri-heart-3-line"></i></button> --}}
        {{-- <button class="wishlist-btn" data-book-id="{{ $book->id }}"
                                        data-book-title="{{ $book->title }}">
                                        <i class="ri-heart-3-line"></i>
                                    </button>
                                    <a href="{{ url("/books/show/$book->id") }}"><i class="ri-eye-line"></i></a>
                                </div>
                            </article>
                        @endforeach
                    </div> --}}
        {{-- <div class="swiper-button-prev">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="ri-arrow-right-s-line"></i>
                    </div> --}}
        {{-- </div>
                <a href="{{ route('books.discountBooks') }}" class="see__more">See All Discount Books >>> </a>
            </div>
        </section> --}}

        <!--==================== NEW BOOKS ====================-->
        <section class="new section" id="new">
            <h2 class="section__title">
                Fresh Pastries
            </h2>
            <div class="new__container container">
                <div class="new__swiper swiper">
                    <div class="swiper-wrapper">
                        @foreach ($pastryProducts as $book)
                            <a href="#" class="new__card swiper-slide">
                                @if ($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="image"
                                        class="new__img">
                                @endif
                                <div>
                                    <h2 class="new__title">{{ $book->name }}</h2>
                                    <div class="new__prices">
                                        <span class="new__discount">${{ $book->price }}</span>
                                    </div>
                                    <div class="new__stars">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-half-line"></i>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <a href="#" class="see__more">See All Pastries >>> </a>
            </div>
        </section>

        <!--==================== TESTIMONIAL ====================-->
        <section class="testimonial section" id="testimonial">
            <h2 class="section__title">
                Customer Opinions
            </h2>
            <div class="testimonial__container container">
                <div class="testimonial__swiper swiper">
                    <div class="swiper-wrapper">
                        <article class="testimonial__card swiper-slide">
                            <img src="{{ asset('storage/photos/gril33.jpg') }}" alt="image"
                                class="testimonial__img">
                            <h2 class="testimonial__title">Rial Loz</h2>
                            <p class="testimonial__description">
                                The best website to buy books, the purchase
                                is very easy to make and has great discounts.
                            </p>

                            <div class="testimonial__stars">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-line"></i>
                            </div>
                        </article>

                        <article class="testimonial__card swiper-slide">
                            <img src="{{ asset('storage/photos/girl11.jpg') }}" alt="image"
                                class="testimonial__img">
                            <h2 class="testimonial__title">Rial Loz</h2>
                            <p class="testimonial__description">
                                The best website to buy books, the purchase
                                is very easy to make and has great discounts.
                            </p>

                            <div class="testimonial__stars">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-line"></i>
                            </div>
                        </article>

                        <article class="testimonial__card swiper-slide">
                            <img src="{{ asset('storage/photos/girl22.jpg') }}" alt="image"
                                class="testimonial__img">
                            <h2 class="testimonial__title">Rial Loz</h2>
                            <p class="testimonial__description">
                                The best website to buy books, the purchase
                                is very easy to make and has great discounts.
                            </p>

                            <div class="testimonial__stars">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-line"></i>
                            </div>
                        </article>

                        <article class="testimonial__card swiper-slide">
                            <img src="{{ asset('storage/photos/girl3.jpg') }}" alt="image"
                                class="testimonial__img">
                            <h2 class="testimonial__title">Rial Loz</h2>
                            <p class="testimonial__description">
                                The best website to buy books, the purchase
                                is very easy to make and has great discounts.
                            </p>

                            <div class="testimonial__stars">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-line"></i>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer__container container grid">
            <div>
                <a href="#" class="footer__logo">
                    <i class="ri-book-3-line"></i>E-Book
                </a>
                <p class="footer__description">
                    Find and explore the best <br>
                    eBooks from all your <br>
                    favorite writers.
                </p>
            </div>
            <div class="footer__data grid">
                <div>
                    <h3 class="footer__title">About</h3>
                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">Awards</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">FAQs</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Privacy policy</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Terms of services</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer__title">Company</h3>
                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">Blogs</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Community</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Our team</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Help center</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer__title">Contact</h3>
                    <ul class="footer__links">
                        <li>
                            <address class="footer__info">
                                Av. Hacienda <br>
                                Lima 4321, Perú
                            </address>
                        </li>
                        <li>
                            <address class="footer__info">
                                e.book@email.com <br>
                                0987-654-321
                            </address>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer__title">Social</h3>
                    <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                        <i class="ri-facebook-circle-line"></i>
                    </a>

                    <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                        <i class="ri-instagram-line"></i>
                    </a>

                    <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                        <i class="ri-twitter-x-line"></i>
                    </a>
                </div>
            </div>
        </div>
        <span class="footer__copy">
            &#169; All Rights Reserved By BookShop
        </span>
    </footer>

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-line"></i>
    </a>

    <!--=============== SCROLLREVEAL ===============-->
    {{-- <script src="assets/js/scrollreveal.min.js"></script> --}}
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    {{-- <script src="assets/js/swiper-bundle.min.js"></script> --}}
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    {{-- <script src="assets/js/main.js"></script> --}}
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- <script src="{{ asset('js/wishlist.js') }}"></script> --}}

</body>

</html>
