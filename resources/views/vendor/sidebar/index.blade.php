<div class="main-sidebar-body">
    <ul class="nav">
        @foreach ($menus as $menu)
            <li class="{{ in_array($menu_active, $menu['roles']) ? 'active': '' }} nav-item">
                <a class="nav-link {{ $menu['has_sub_menu'] ? 'with-sub' : '' }}" href="{{ $menu['has_sub_menu'] ? 'javaScript:void(0);' : route($menu['route']) }}">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="{{ $menu['icon'] }} sidemenu-icon"></i>
                    <span class="sidemenu-label">{{ $menu['name'] }}</span>
                    @if($menu['has_sub_menu'])
                        <i class="angle fe fe-chevron-right"></i>
                    @endif
                </a>
                @if($menu['has_sub_menu'])
                    <ul class="nav-sub {{ in_array($menu_active, $menu['roles']) ? 'in': '' }}">
                        @foreach ($menu['sub'] as $subMenu)
                            <li class="nav-sub-item">
                                <a class="nav-sub-link {{ $menu_active == $subMenu['roles'] ? 'active': '' }}" data-roles="{{ $subMenu['roles'] }}" href="{{ route($subMenu['route']) }}">
                                    @lang($subMenu['name'])
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>