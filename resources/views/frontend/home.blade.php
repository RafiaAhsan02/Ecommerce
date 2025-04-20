@extends('layouts.frontend.master')

{{-- main shop homepage! --}}
@section('content')

    <!-- slider area start -->
    @include('frontend.slider')
    <!-- slider area end -->

    <!-- value added services -->
    <div class="feature-style-one pt-70 pb-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-inner fix">
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper1.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>free shipping</h4>
                                    <p>free shipping on all us order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper2.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Support 24/7</h4>
                                    <p>Contact us 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper3.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>100% Money Back</h4>
                                    <p>You have 30 days to Return</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="{{ asset('assets/frontend/img/icon/wrapper5.png') }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Payment Secure</h4>
                                    <p>We ensure secure payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Products start -->
    <div class="product-wrapper fix pt-15 pb-55">
        <div class="container-fluid">
            <div class="section-title product-spacing">
                <h3><span>New</span> Arrivals</h3>
            </div>
            <div class="product-gallary-wrapper">
                <div class="product-gallary-active owl-carousel owl-arrow-style product-spacing">
                    @forelse ($newProducts as $key => $newProduct)
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="{{ route('product.detail', $newProduct->slug) }}">
                                    @forelse ($newProduct->productImages as $key => $image)
                                        <img src="{{ asset($image->image) }}" class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}" alt="">
                                    @empty
                                    @endforelse
                                </a>
                                <div class="box-label">
                                    <div class="label-product label_new">
                                        <span>New</span>
                                    </div>
                                    @if ($newProduct->discount > 0)
                                        <div class="label-product label_sale">
                                            <span>-{{ $newProduct->discount }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="action-links">
                                    <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                    <a href="#" title="Quick view" data-bs-target="#quick_view" data-bs-toggle="modal">
                                        <i class="lnr lnr-magnifier"></i></a>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a href="{{ route('brand.product', $newProduct->brand->slug) }}">
                                            {{ $newProduct->brand->name ?? '' }}
                                        </a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="{{ route('product.detail', $newProduct->slug) }}">
                                            {{ $newProduct->name }}
                                        </a></h4>
                                </div>
                                <div class="ratings">
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                </div>
                                <div class="price-box">
                                    @if ($newProduct->discount > 0)
                                        <span class="regular-price"><span
                                                class="special-price">&#2547;{{ number_format($newProduct->discount_price) }}</span></span>
                                        <span class="old-price"><del>&#2547; {{ number_format($newProduct->price) }}</del></span>
                                    @else
                                        <span class="old-price">&#2547; {{ number_format($newProduct->price) }}</span>
                                    @endif
                                </div>
                                <form action="{{ route('cart.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $newProduct->id }}">
                                    <button class="btn-cart" type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        No new products found.
                    @endforelse
                </div>
            </div>

        </div>
    </div>
    <!-- New Products end -->

    <!-- Ad Banner -->
    <div class="banner-statics">
        <div class="container-fluid">
            <div class="single-banner-statics">
                <a href="#"><img src="assets/frontend/img/banner/img-bottom-sinrato1.jpg" alt=""></a>
            </div>
        </div>
    </div>
    <!-- Ad Banner end -->

    <!-- Featured Products area start -->
    <div class="product-wrapper fix pt-15 pb-55">
        <div class="container-fluid">
            <div class="section-title product-spacing">
                <h3><span>Featured</span> Products</h3>
            </div>
            <div class="product-gallary-wrapper">
                <div class="product-gallary-active owl-carousel owl-arrow-style product-spacing">
                    @forelse ($featuredProducts as $key => $featuredProduct)
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="{{ route('product.detail', $featuredProduct->slug) }}">
                                    @forelse ($featuredProduct->productImages as $key => $image)
                                        <img src="{{ asset($image->image) }}" class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}"
                                            alt="">
                                    @empty
                                    @endforelse
                                </a>
                                <div class="box-label">
                                    <div class="label-product label_new">
                                        <span>new</span>
                                    </div>
                                    @if ($featuredProduct->discount > 0)
                                        <div class="label-product label_sale">
                                            <span>-{{ $featuredProduct->discount }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="action-links">
                                    <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                    <a href="#" title="Quick view" data-bs-target="#quick_view" data-bs-toggle="modal"><i
                                            class="lnr lnr-magnifier"></i></a>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a href="{{ route('brand.product', $featuredProduct->brand->slug) }}">
                                            {{ $featuredProduct->brand->name ?? '' }}
                                        </a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="{{ route('product.detail', $featuredProduct->slug) }}">
                                            {{ $featuredProduct->name }}
                                        </a></h4>
                                </div>
                                <div class="ratings">
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                    <span class="yellow"><i class="lnr lnr-star"></i></span>
                                </div>
                                <div class="price-box">
                                    @if ($featuredProduct->discount > 0)
                                        <span class="regular-price"><span
                                                class="special-price">&#2547; {{ number_format($featuredProduct->discount_price) }}</span></span>
                                        <span class="old-price"><del>&#2547; {{ number_format($featuredProduct->price) }}</del></span>
                                    @else
                                        <span class="old-price">&#2547; {{ number_format($featuredProduct->price) }}</span>
                                    @endif

                                </div>
                                <form action="{{ route('cart.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $featuredProduct->id }}">
                                    <button class="btn-cart" type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                        <!-- </div> end single item -->
                    @empty
                        Featured products not available
                    @endforelse

                </div>
            </div>

        </div>
    </div>
    <!-- Featured Products area end -->

    <!-- Brand area start -->
    <div class="brand-area-home2 pt-30 pb-70">
        <div class="container-fluid">
            <div class="brand2-slider-wrapper">
                <div class="brand2-slider-active">
                    @forelse ($brands as $brand)
                        <div class="single-brand-logo">
                            <a href="{{ route('brand.product', $brand->slug) }}" class="brand-logo-carousel"><img src="{{ asset($brand->image) }}" alt=""></a>
                        </div>
                    @empty
                        No brands found.
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Brand area end -->

    <!-- Quick view modal start -->
    <div class="modal fade" id="quick_view">
        <div class="container">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider mb-20">
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-4.jpg" alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-5.jpg" alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-6.jpg" alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-7.jpg" alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-8.jpg" alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-9.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="pro-nav">
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-4.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-5.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-6.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-7.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-8.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-9.jpg" alt="" /></div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-inner">
                                    <div class="product-details-contentt">
                                        <div class="pro-details-name mb-10">
                                            <h3>Bose SoundLink Bluetooth Speaker</h3>
                                        </div>
                                        <div class="pro-details-review mb-20">
                                            <ul>
                                                <li>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                </li>
                                                <li><a href="#">1 Reviews</a></li>
                                            </ul>
                                        </div>
                                        <div class="price-box mb-15">
                                            <span class="regular-price"><span class="special-price">&#2547;50.00</span></span>
                                            <span class="old-price"><del>&#2547;60.00</del></span>
                                        </div>
                                        <div class="product-detail-sort-des pb-20">
                                            <p>Canon's press material for the EOS 5D states that it 'defines (a) new
                                                D-SLR category', while we're not typically too concerned</p>
                                        </div>
                                        <div class="pro-details-list pt-20">
                                            <ul>
                                                <li><span>Availability :</span>In Stock</li>
                                            </ul>
                                        </div>
                                        <div class="product-availabily-option mt-15 mb-15">
                                            <h3>Available Options</h3>
                                            <div class="color-optionn">
                                                <h4><sup>*</sup>color</h4>
                                                <ul>
                                                    <li>
                                                        <a class="c-black" href="#" title="Black"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-blue" href="#" title="Blue"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-brown" href="#" title="Brown"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-gray" href="#" title="Gray"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-red" href="#" title="Red"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="pro-quantity-box mb-30">
                                            <div class="qty-boxx">
                                                <label>qty :</label>
                                                <input type="text" placeholder="0">
                                                <button class="btn-cart lg-btn">Add to Cart</button>
                                            </div>
                                        </div>
                                        <div class="pro-social-sharing">
                                            <label>share :</label>
                                            <ul>
                                                <li class="list-inline-item">
                                                    <a href="#" class="bg-facebook" title="Facebook">
                                                        <i class="fa fa-facebook"></i>
                                                        <span>like 0</span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="bg-twitter" title="Twitter">
                                                        <i class="fa fa-twitter"></i>
                                                        <span>tweet</span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="bg-google" title="Google Plus">
                                                        <i class="fa fa-google-plus"></i>
                                                        <span>google +</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick view modal end -->


@endsection

@push('page_css')
    <style>
        .brand-logo-carousel img {
            width: 110px !important;
        }
    </style>
@endpush