<header class="header">
    {{-- Main container start --}}
    <div class="main-container header__inner">
        {{-- Logo start --}}
        <a href="{{ route('home') }}" class="logo">
            <img class="logo__image" src="{{ asset('img/main/logo.svg') }}" alt="Neo universe logo">
        </a>  {{-- Logo end --}}

        {{-- Search start --}}
        <form class="search" action="{{ route('search') }}" method="GET">
            <input type="text" class="search__input">
            <button type="button" class="search__button">
                <span class="material-icons-outlined search__icon">search</span>
            </button>
        </form>  {{-- Search end --}}

        {{-- Navbar start --}}
        <nav class="navbar">
            <ul class="navbar__list">
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('about_us') }}">О нас</a>
                </li>

                <li class="navbar__item">
                    <a class="navbar__link" href="#">Продукты</a>
                </li>

                <li class="navbar__item">
                    <a class="navbar__link" href="#">Новости</a>
                </li>
            </ul>
        </nav>  {{-- Navbar end --}}

        {{-- Contact start --}}
        <button class="header__contact-us">
            <span class="material-icons-outlined search__icon">portrait</span> Связатсья с нами
        </button>  {{-- Contact end --}}

    </div>  {{-- Main container end --}}
</header>