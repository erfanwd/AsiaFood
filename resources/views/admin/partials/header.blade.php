<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{route('admin.food.index')}}" class="nav-link px-2 text-white">Foods</a></li>
                <li><a href="{{route('admin.category.index')}}" class="nav-link px-2 text-white">Categories</a></li>
                <li><a href="{{route('admin.order.index')}}" class="nav-link px-2 text-white">Orders</a></li>
            </ul>


            @auth()
                <ul class="nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown08" data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()->name}}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown08">
                            <li><a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            @endauth()

        </div>
    </div>
</header>
