 <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">
                <img src="{{ asset('storage/photos/logo-pizza.svg') }}" alt="image">
                Pizza
            </a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li>
                        <a href="#home" class="nav__link active-link">Home</a>
                    </li>
                    <li>
                        <a href="#about" class="nav__link">About Us</a>
                    </li>
                    <li>
                        <a href="#popular" class="nav__link">Popular</a>
                    </li>
                    <li>
                        <a href="#products" class="nav__link">Products</a>
                    </li>
                    <li>
                        <a href="#contact" class="nav__link">Contact</a>
                    </li>
                    <li>
                         @auth
                    @php
                        $user = auth()->user();
                    @endphp

                    @if ($user->hasRole(['Admin', 'Super Admin']))
                        <a href="{{ route('dashboard') }}" title="Admin Dashboard" class="nav__link">
                            <i class="ri-dashboard-line"></i>
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; cursor: pointer;">
                            <i class="ri-logout-box-r-line nav__link" title="Logout"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class=" nav__link">
                        {{-- <i class="ri-login-circle-line"></i> --}} Login
                    </a>
                    {{-- <a wire:navigate href="{{ route('register') }}" class=" nav__link">
                        <i class="ri-user-line"></i>
                    </a> --}}
                @endauth

                    </li>

                    
                </ul>
                <!--- Close button -->
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-large-line"></i>
                </div>
            </div>
            <!-- Toggle button -->
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-apps-2-fill"></i>
            </div>
        </nav>
    </header>