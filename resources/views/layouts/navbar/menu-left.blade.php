<ul class="col-6 navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">Главная</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('basket') }}">Корзина</a>
    </li>
    <li class="nav-item active">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Товары</a>
            <div class="dropdown">
                <ul class="dropdown-menu">
                    @foreach($categories as $category)
                        <li>
                            @if($category['id'] > 0)
                                <a href="{{route('productsMain', ['category_id' => $category['id']])}}">
                                    {{ $category['name'] }}
                                </a>
                            @else
                                <a href="{{route('productsMain')}}">
                                    {{ $category['name'] }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
{{--            <div class="dropdown">--}}
{{--                <ul class="dropdown-menu">--}}
{{--                    <li>--}}
{{--                        <a tabindex="-1" href="#">HTML</a>--}}
{{--                    </li>--}}
{{--                    <li><a tabindex="-1" href="#">CSS</a></li>--}}
{{--                    <li class="dropdown-submenu">--}}
{{--                        <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li><a tabindex="-1" href="#">2nd level dropdown</a></li>--}}
{{--                            <li><a tabindex="-1" href="#">2nd level dropdown</a></li>--}}
{{--                            <li class="dropdown-submenu">--}}
{{--                                <a class="test" href="#">Another dropdown <span class="caret"></span></a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li><a href="#">3rd level dropdown</a></li>--}}
{{--                                    <li><a href="#">3rd level dropdown</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
    </li>
</ul>
