@extends('layouts.frontend.master')

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area mb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="container-fluid">
        <h1>Shop All Products</h1>
        {{-- run if loop based on route, add brand, category, or subcategory --}}
    </div>

    <!-- shop page main wrapper start -->
    <div class="main-wrapper pt-40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-shop-main-wrapper">
                        {{-- Ad Banner --}}
                        <div class="shop-banner-img mb-50">
                            <a href="#"><img src="{{ asset('assets/frontend/img/banner/category-image.jpg') }}" alt=""></a>
                        </div>

                        {{-- Top Bar --}}
                        <div class="shop-top-bar mb-30">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a href="#" data-target="column_3"><span>3-col</span></a>
                                            <a class="active" href="#" data-target="grid"><span>4-col</span></a>
                                            <a href="#" data-target="list"><span>list</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- <div class="top-bar-right">
                                        <div class="per-page">
                                            <p>Show : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">10</option>
                                                <option value="sales">20</option>
                                                <option value="sales">30</option>
                                                <option value="rating">40</option>
                                                <option value="date">50</option>
                                                <option value="price-asc">60</option>
                                                <option value="price-asc">70</option>
                                                <option value="price-asc">100</option>
                                            </select>
                                        </div>
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name (A - Z)</option>
                                                <option value="sales">Name (Z - A)</option>
                                                <option value="rating">Price (Low &gt; High)</option>
                                                <option value="date">Rating (Lowest)</option>
                                                <option value="price-asc">Model (A - Z)</option>
                                                <option value="price-asc">Model (Z - A)</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                        </div>

                        {{-- Products --}}
                        <div class="shop-product-wrap grid row">
                            @forelse ($products as $key => $product)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    {{-- grid view compatible product --}}
                                    <div class="product-item mb-30">
                                        <div class="product-thumb">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                @forelse ($product->productImages as $key => $image)
                                                    <img src="{{ asset($image->image) }}"
                                                        class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}" alt="">
                                                @empty
                                                @endforelse
                                            </a>
                                            <div class="box-label">
                                                <div class="label-product label_new">
                                                    <span>New</span>
                                                </div>
                                                @if ($product->discount > 0)
                                                    <div class="label-product label_sale">
                                                        <span>-{{ $product->discount }}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="action-links">
                                                <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                                <a href="#" title="Quick view" data-bs-target="#quickk_view"
                                                    data-bs-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <div class="manufacture-product">
                                                <p><a href="{{ route('brand.product', $product->brand->slug) }}">
                                                        {{ $product->brand->name ?? '' }}
                                                    </a></p>
                                            </div>
                                            <div class="product-name">
                                                <h4>
                                                    <a href="{{ route('product.detail', $product->slug) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="price-box">
                                                @if ($product->discount > 0)
                                                    <span class="regular-price"><span
                                                            class="special-price">&#2547;{{ number_format($product->discount_price) }}</span></span>
                                                    <span class="old-price"><del>&#2547;
                                                            {{ number_format($product->price) }}</del></span>
                                                @else
                                                    <span class="regular-price">&#2547; {{ number_format($product->price) }}</span>
                                                @endif
                                            </div>
                                            <form action="{{ route('cart.add') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="btn-cart" type="submit">Add to Cart</button>
                                            </form>
                                        </div>
                                    </div> <!-- end single grid item -->

                                    {{-- list view compatible product --}}
                                    <div class="sinrato-list-item mb-30">
                                        <div class="sinrato-thumb">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                @forelse ($product->productImages as $key => $image)
                                                    <img width="150" src="{{ asset($image->image) }}"
                                                        class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}" alt="">
                                                @empty
                                                @endforelse
                                            </a>
                                            <div class="box-label">
                                                <div class="label-product label_sale">
                                                    <span>New</span>
                                                </div>
                                                @if ($product->discount > 0)
                                                    <div class="label-product label_sale">
                                                        <span>-{{ $product->discount }}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="sinrato-list-item-content">
                                            <div class="manufacture-product">
                                                <span><a href="{{ route('brand.product', $product->brand->slug) }}">
                                                        {{ $product->brand->name ?? '' }}
                                                    </a></span>
                                            </div>
                                            <div class="sinrato-product-name">
                                                <h4>
                                                    <a href="{{ route('product.detail', $product->slug) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="sinrato-product-des">
                                                <p>{{ $product->short_description }}</p>
                                                {{-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis
                                                    voluptatibus similique placeat molestias quam incidunt necessitatibus! Rerum
                                                    voluptatem consequuntur cupiditate et perspiciatis? Eaque, molestias
                                                    eligendi.</p> --}}
                                            </div>
                                        </div>
                                        <div class="sinrato-box-action">
                                            <div class="price-box">
                                                @if ($product->discount > 0)
                                                    <span class="regular-price"><span
                                                            class="special-price">&#2547;{{ number_format($product->discount_price) }}</span></span>
                                                    <span class="old-price"><del>&#2547;
                                                            {{ number_format($product->price) }}</del></span>
                                                @else
                                                    <span class="regular-price">&#2547; {{ number_format($product->price) }}</span>
                                                @endif
                                            </div>
                                            <form action="{{ route('cart.add') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="btn-cart" type="submit">Add to Cart</button>
                                            </form>

                                            <div class="action-links sinrat-list-icon">
                                                <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                                <a href="#" title="Quick view" data-bs-target="#quickk_view"
                                                    data-bs-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
                                            </div>
                                        </div>
                                    </div> <!-- end single list item -->
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="paginatoin-area style-2 pt-35 pb-20">
                        <div class="row">
                            {{ $products->links() }}
                            {{-- <ul class="pagination-box pagination-style-2">
                                customize?
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop page main wrapper end -->


@endsection