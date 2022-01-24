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
                Продукты / {{$product->ru_title}}
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

            @case('dashboard.projects.index')
                <span>Элементов : {{$items_count}}</span>
                <a href="{{route('dashboard.projects.groups.index')}}">Группы</a>
                <a href="{{route('dashboard.projects.create')}}">Добавить проект</a>
                <button class="button--undecorated" type="button" data-bs-toggle="modal"
                    data-bs-target="#remove_multiple_modal">Удалить отмеченные</button>
            @break

            @case('dashboard.projects.groups.index')
                <span class="header__actions-span">Элементов : {{$items_count}}</span>
                <a class="header__actions-link" href="{{route('dashboard.projects.groups.create')}}">Добавить группу</a>
                <button class="header__actions-button" type="button" data-bs-toggle="modal"
                    data-bs-target="#remove_multiple_modal">Удалить отмеченные</button>
            @break

        @endswitch
    </div> {{-- Header actions end --}}

</header>