<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('store.index') }}">
                        <img src="/img/logo.png" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                            {{-- Home --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('store.index') ? 'active' : '' }}"
                                   href="{{ route('store.index') }}">Home</a>
                            </li>

                            {{-- Shop --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown_1"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Shop
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                    <a class="dropdown-item" href="#{{--route('store.category')--}}">
                                        <i class="fas fa-th-large me-2"></i>Shop Category
                                    </a>
                                </div>
                            </li>

                            {{-- Pages --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown_3"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pages
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_3">
                                    <a class="dropdown-item" href="#{{--route('store.tracking')--}}">
                                        <i class="fas fa-truck me-2"></i>Order Tracking
                                    </a>
                                    <a class="dropdown-item" href="#{{--route('store.checkout')--}}">
                                        <i class="fas fa-credit-card me-2"></i>Checkout
                                    </a>
                                    <a class="dropdown-item" href="#{{--route('store.cart')--}}">
                                        <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
                                    </a>
                                </div>
                            </li>

                            {{-- Blog --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown_2"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Blog
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                    <a class="dropdown-item" href="#{{--route('store.blog')--}}">
                                        <i class="fas fa-blog me-2"></i>Blog
                                    </a>
                                </div>
                            </li>

                            {{-- Contact --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('store.contact') ? 'active' : '' }}"
                                   href="#{{--route('store.contact')--}}">Contact</a>
                            </li>

                        </ul>
                    </div>

                    {{-- ===== Right Icons ===== --}}
                    <div class="hearer_icon d-flex align-items-center gap-2">

                        {{-- Search --}}
                        <a id="search_1" href="javascript:void(0)">
                            <i class="ti-search"></i>
                        </a>

                        {{-- Cart --}}
                        <a href="#{{--route('store.cart')--}}" class="position-relative">
                            <i class="fas fa-cart-plus"></i>
                            @auth
                                @php
                                    $cartCount = \App\Models\CartItem::whereHas('cart', function($q){
                                        $q->where('user_id', auth()->id());
                                    })->sum('quantity');
                                @endphp
                                @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle
                                             badge rounded-pill bg-danger"
                                      style="font-size:10px;">
                                    {{ $cartCount > 99 ? '99+' : $cartCount }}
                                </span>
                                @endif
                            @endauth
                        </a>

                        {{-- ===== Auth Section ===== --}}
                        @guest
                            {{-- زائر: Login / Register --}}
                            <a href="#{{--route('login')--}}"
                               class="btn btn-sm btn-outline-dark px-3 ms-2">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                            <a href="#{{--route('register')--}}"
                               class="btn btn-sm btn-dark px-3">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        @else
                            {{-- مستخدم مسجل: Dropdown --}}
                            <div class="dropdown ms-2">
                                <a class="dropdown-toggle d-flex align-items-center gap-2 text-dark text-decoration-none"
                                   href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-expanded="false">
                                    {{-- Avatar --}}
                                    <div class="rounded-circle bg-dark text-white d-flex align-items-center
                                                justify-content-center fw-bold"
                                         style="width:34px;height:34px;font-size:13px;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="d-none d-lg-inline fw-semibold small">
                                        {{ Auth::user()->name }}
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2"
                                     aria-labelledby="userDropdown"
                                     style="min-width:200px;">

                                    {{-- User Info --}}
                                    <div class="px-3 py-2 border-bottom">
                                        <p class="fw-bold mb-0 small">{{ Auth::user()->name }}</p>
                                        <p class="text-muted mb-0" style="font-size:11px;">
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>

                                    {{-- Links --}}
                                    <a class="dropdown-item py-2" href="#{{--route('addresses.index')--}}">
                                        <i class="fas fa-map-marker-alt me-2 text-muted"></i>My Addresses
                                    </a>

                                    <a class="dropdown-item py-2" href="#{{--route('store.tracking')--}}">
                                        <i class="fas fa-truck me-2 text-muted"></i>Track My Orders
                                    </a>

                                    <a class="dropdown-item py-2" href="#{{--route('store.cart')--}}">
                                        <i class="fas fa-shopping-cart me-2 text-muted"></i>My Cart
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    {{-- Logout --}}
                                    <form method="POST" action="#{{--route('logout')--}}">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest

                    </div>
                </nav>
            </div>
        </div>
    </div>

    {{-- Search Box --}}
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between search-inner"
                  action="#{{--route('store.category')--}}" method="GET">
                <input type="text" name="search" class="form-control"
                       id="search_input" placeholder="Search products...">
                <button type="submit" class="btn"></button>
                <span class="ti-close" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
