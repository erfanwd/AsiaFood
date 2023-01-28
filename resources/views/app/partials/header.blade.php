<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{route('app.food.index')}}" class="nav-link px-2 text-white">Foods</a></li>

            </ul>



            @auth()
                <ul class="nav">
                    <li><a href="{{route('admin.food.index')}}" class="nav-link px-2 text-success">admin</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown08" data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()->name}}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown08">
                            <li><a class="dropdown-item" href="{{route('user.orders')}}">Orders</a></li>
                            <li><a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>

            @endauth()

            @guest()
            <div class="text-end">
                <a class="btn btn-success me-2" href="{{route('auth.login')}}" tabindex="-1" aria-disabled="true">Login</a>
                <a class="btn btn-outline-success" href="{{route('auth.register')}}" tabindex="-1" aria-disabled="true">Register</a>
            </div>
            @endguest
        </div>
    </div>
</header>
