<header class="header" id="header">
    <span class="material-icons-outlined aside-toggler" onclick="toggle_aside()"
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="На весь экран">menu
    </span>

    {{-- Header Title start --}}
    <h1 class="header__title">
        @switch($route)

            @case('dashboard.index')
                Продукты ({{$itemsCount}})
            @break

            @case('dashboard.products.create')
                Продукты / Добавить продукт
            @break

            @case('dashboard.products.single')
                Продукты / Редактировать / {{$product->ru_name}}
            @break

            @case('dashboard.news.index')
                Новости ({{$itemsCount}})
            @break

            @case('dashboard.news.create')
                Новости / Добавить новость
            @break

            @case('dashboard.news.single')
                Новости / Редактировать / {{$news->ru_title}}
            @break

            @case('dashboard.options.index')
                Тексты ({{$itemsCount}})
            @break

            @case('dashboard.options.single')
                Тексты / Редактировать / {{$option->key}}
            @break

        @endswitch
    </h1> {{-- Header Title end --}}


    {{-- Header actions start --}}
    <div class="header__actions">
        {{-- Routes may have different actions --}}
        @switch($route)

            @case('dashboard.index')
                <a href="{{route('dashboard.products.create')}}">Добавить</a>
                <a href="{{route('dashboard.products.create')}}">Направления</a>
                <a href="{{route('dashboard.products.create')}}">Симптомы</a>
                <a href="{{route('dashboard.products.create')}}">Формы</a>
                <button onclick="select_all_checkboxes()">Отметить все</button>
                <button data-bs-toggle="modal" data-bs-target="#remove_items_modal">Удалить отмеченные</button>
            @break

            @case('dashboard.news.index')
                <a href="{{route('dashboard.news.create')}}">Добавить</a>
                <a href="{{route('dashboard.news.create')}}">Категории</a>
                <button onclick="select_all_checkboxes()">Отметить все</button>
                <button data-bs-toggle="modal" data-bs-target="#remove_items_modal">Удалить отмеченные</button>
            @break

        @endswitch
    </div> {{-- Header actions end --}}

</header>