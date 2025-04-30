<header class="header-pos">
    <div class="header-top black-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="header-top-left">
                        <ul>
                            <li><span>Email: </span>support@sinrato.com</li>
                            <li>Free Shipping for all Order over $99</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="box box-right">
                        <!-- Authentication Links -->
                        <ul class="d-flex">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-warning" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link text-warning" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif

                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-warning" href="#" role="button" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <span class="text-warning"> | </span>

                                    @if (Auth::user()->type == "user")
                                        {{-- insert user profile/dashboard here --}}
                                        <a class="nav-link text-warning" href="{{ route('user.dashboard') }}"
                                                role="button" aria-haspopup="true" aria-expanded="false" v-pre>Dashboard</a>
                                            <span class="text-warning"> | </span>
                                    
                                    @elseif (Auth::user()->type == "admin")
                                        <a class="nav-link text-warning" href="{{ route('admin.dashboard') }}" target="_blank"
                                            role="button" aria-haspopup="true" aria-expanded="false" v-pre>Dashboard</a>
                                        <span class="text-warning"> | </span>
                                        
                                        @elseif (Auth::user()->type == "manager")
                                        <a class="nav-link text-warning" href="#" role="button" aria-haspopup="true"
                                            aria-expanded="false" v-pre>Dashboard</a>
                                        <span class="text-warning"> | </span>
                                    @else
                                    @endif

                                    <a class="nav-link text-warning" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img
                                src="{{ asset('assets/frontend/img/logo/logo-sinrato.png') }}" alt="brand-logo"></a>
                    </div>
                </div>

                {{-- Search --}}
                <div class="col-lg-6 col-md-12 col-12 order-sm-last">
                    <div class="header-middle-inner">
                        <form action="method">
                            <div class="top-cat hm1">
                                <div class="search-form">
                                    <select style="display: none;">
                                        <optgroup label="Electronics">
                                            <option value="volvo">Laptop</option>
                                            <option value="saab">watch</option>
                                        </optgroup>
                                    </select>
                                    <div class="nice-select" tabindex="0"><span class="current">Laptop</span>
                                        <ul class="list">
                                            <li data-value="volvo" class="option selected">Laptop</li>
                                            <li data-value="saab" class="option">watch</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="top-cat-field" placeholder="Search entire store here">
                            <input type="button" class="top-search-btn" value="Search">
                        </form>
                    </div>
                </div>

                {{-- Wishlist and Cart --}}
                <div class="col-lg-3 col-md-8 col-12 col-sm-8 order-lg-last">
                    <div class="mini-cart-option">
                        <ul>
                            <li class="wishlist">
                                <a class="ha-toggle" href="wishlist.html">
                                    {{-- <span class="count">1</span> --}}
                                    <span class="lnr lnr-heart"></span>
                                    Wishlist
                                </a>
                            </li>

                            @php
                                $cartItems = session()->get('cart', []);
                            @endphp
                            <li class="my-cart">
                                <button type="button" class="ha-toggle">
                                    @if (count($cartItems) > 0)
                                        <span class="count">{{ count($cartItems) }}</span>
                                        {{-- should do sum instead? --}}
                                    @endif
                                    <span class="lnr lnr-cart"></span>
                                    My Cart
                                </button>

                                {{-- Cart item dropdown --}}
                                <ul class="mini-cart-drop-down ha-dropdown">
                                    @php
                                        $total = 0;
                                    @endphp
                                    <h3 class="mb-3">In Cart:</h3>
                                    @if (count($cartItems) > 0)
                                        @forelse ($cartItems as $key => $item)
                                            @php
                                                $total += $item['price'] * $item['quantity'];
                                            @endphp
                                            <li class="mb-15">
                                                <div class="cart-img col-2">
                                                    <img src="{{ $item['image'] ?? '' }}" alt="Image of {{ $item['name'] }}">
                                                </div>
                                                <div class="cart-info">
                                                    <h4><a href="{{ route('product.detail', $item['slug']) }}">{{ $item['name'] }}</a>
                                                    </h4>
                                                    <span> <span>{{ $item['quantity'] }} x
                                                        </span>&#2547;{{ number_format($item['price']) }}</span>
                                                </div>

                                                <form action="{{ route('cart.destroy', $key) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="product_id" value="{{ $key }}">
                                                        <button type="submit" class="del-icon" title="Remove item" onclick="return confirm('Are you sure you want to remove this item from cart?')"><i class="fa fa-times-circle"></i></button>
                                                </form>
                                            </li>
                                            <hr>
                                        @empty
                                        @endforelse

                                        <li class="mb-1">
                                            <div class="subtotal-text">Delivery: </div>
                                            <div class="subtotal-price">&#2547;100</div>
                                        </li>
                                        <li>
                                            <div class="subtotal-text">Total: </div>
                                            <div class="subtotal-price">&#2547;{{ number_format($total + 100) }}</div>
                                        </li>
                                    @else
                                        <li>
                                            <div class="">
                                                <h5>There are no products in cart.</h5>
                                            </div>
                                        </li>
                                    @endif

                                    <li class="mt-30">
                                        <a class="cart-button" href="{{ route('cart.index') }}">View Cart</a>
                                    </li>
                                    <li>
                                        <a class="cart-button" href="{{ route('checkout') }}">Checkout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Bar --}}
    <div class="header-top-menu theme-bg sticker">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-main-menu">
                        <div class="categories-menu-bar">
                            <div class="categories-menu-btn ha-toggle">
                                <div class="left">
                                    <i class="lnr lnr-text-align-left"></i>
                                    <span>Browse Categories</span>
                                </div>
                                <div class="right">
                                    <i class="lnr lnr-chevron-down"></i>
                                </div>
                            </div>
                            <nav class="categorie-menus ha-dropdown">
                                <ul id="menu2">
                                    @forelse($categories as $key => $category)
                                        <li>
                                            <a href="{{ route('category.product', $category->slug) }}">{!! $category->name !!}
                                                @if ($category->subCategories->count() > 0)
                                                    <span class="lnr lnr-chevron-right"></span>
                                                @endif
                                            </a>
                                            @if ($category->subCategories->count() > 0)
                                                <ul class="cat-submenu">
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <li><a
                                                                href="{{ route('category.product', [$category->slug, $subCategory->slug]) }}">{!! $subCategory->name !!}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </nav>
                        </div>
                        <div class="main-menu">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('products') }}">Shop</a></li>
                                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                </ul>
                            </nav>
                        </div> <!-- end main menu -->

                        <div class="header-call-action">
                            <p><span class="lnr lnr-phone"></span>Hotline : <strong>1-001-234-5678</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
</header>