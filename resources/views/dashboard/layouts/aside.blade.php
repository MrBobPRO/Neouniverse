<aside class="aside" id="aside">
    <a class="aside__logo" href="{{ route('home') }}" target="_blank">
        <img src="{{ asset('img/main/logo.svg') }}">
    </a>

    <img class="aside__avatar" src="{{ asset('img/main/admin.jpg') }}">

    <nav class="aside__nav">
        <ul>
            <li>
                <a class="@if( strpos($route, 'products') !== false || $route == 'dashboard.index') active @endif" href="{{route('dashboard.index')}}">
                    <span class="material-icons">medication</span> Продукты
                </a>
            </li>

            <li>
                <a class="@if( strpos($route, 'news') !== false ) active @endif" href="{{route('dashboard.news.index')}}">
                    <span class="material-icons">article</span> Новости
                </a>
            </li>

            <li>
                <a class="@if( strpos($route, 'texts') !== false ) active @endif" href="{{route('dashboard.news.index')}}">
                    <span class="material-icons">notes</span> Тексты
                </a>
            </li>

            <li>
                <a class="@if( strpos($route, 'translations') !== false ) active @endif" href="{{route('dashboard.news.index')}}">
                    <span class="material-icons">translate</span> Переводы
                </a>
            </li>

            <li class="aside__nav-li">
                <form class="aside__form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><span class="material-icons">logout</span> Выйти</button>
                </form>
            </li>
            
        </ul>
    </nav>
</aside>