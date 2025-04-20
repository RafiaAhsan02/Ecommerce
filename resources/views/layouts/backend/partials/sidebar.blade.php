<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo">
                <img src="{{ asset('assets/backend/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
            
                <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-item {{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('admin/subcategory*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subcategory.index') }}" class="nav-link">
                        <i class="fas fa-th-list"></i>
                        <p>Subcategories</p>
                    </a>
                </li>
                
                <li class="nav-item {{ Request::is('admin/brand*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brand.index') }}" class="nav-link">
                        <i class="fas fa-star"></i>
                        <p>Brands</p>
                    </a>
                </li>
                
                <li class="nav-item {{ Request::is('admin/product*') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}" class="nav-link">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Products</p>
                    </a>
                </li>
                
                <li class="nav-item {{ Request::is('admin/slider*') ? 'active' : '' }}">
                    <a href="{{ route('admin.slider.index') }}" class="nav-link">
                        <i class="fas fa-image"></i>
                        <p>Slider</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>