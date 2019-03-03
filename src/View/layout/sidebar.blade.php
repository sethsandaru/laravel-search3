<div class="sidebar" data-image="{{asset('vendor/search3/images/sidebar.jpg')}}" data-color="blue">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                Search 3
            </a>
        </div>
        <ul class="nav">
            @foreach(SethPhat\Search3\Constant\SidebarConstant::ITEMS as $sidebar_item)
                <li class="nav-item">
                    <a class="nav-link" href="{{route($sidebar_item['route'])}}">
                        <i class="fa {{$sidebar_item['icon']}}"></i>
                        <p>@lang($sidebar_item['title'])</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>