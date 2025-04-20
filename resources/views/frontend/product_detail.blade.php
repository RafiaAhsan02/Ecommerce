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
                                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="container-fluid mb-3">
        <h2>Product Details:</h2>
    </div>

    <!-- product details wrapper start -->
    <div class="product-details-main-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="product-large-slider mb-20">
                        @if ($product->productImages->count() > 0)
                            @foreach ($product->productImages as $image)
                                <div class="pro-large-img">
                                    <img src="{{ asset($image->image) }}" alt="" />
                                    <div class="img-view">
                                        <a class="img-popup" href="{{ asset($image->image) }}">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="pro-nav">
                        @if ($product->productImages->count() > 0)
                            @foreach ($product->productImages as $image)
                                <div class="pro-nav-thumb"><img src="{{ asset($image->image) }}" alt="" /></div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product-details-inner">
                        <div class="product-details-contentt">
                            <div class="pro-details-name mb-10">
                                <h3>{{ $product->name }}</h3>
                            </div>
                            <div class="price-box mb-15">
                                @if ($product->discount)
                                    <span class="regular-price">
                                        <span class="special-price">&#2547;{{ number_format($product->discount_price) }}</span>
                                    </span>
                                    <span class="old-price"><del>&#2547;{{ number_format($product->price) }}</del></span>
                                @else
                                    <span class="regular-price">&#2547;{{ number_format($product->price) }}</span>
                                @endif
                            </div>
                            <div class="product-detail-sort-des pb-20">
                                <p>{{ $product->short_description }}</p>
                            </div>
                            <div class="pro-details-list pt-20">
                                <ul>
                                    <li><span>Brand:</span><a href="{{ route('brand.product', $product->brand->slug) }}">{{ $product->brand->name ?? '' }}</a></li>
                                    <li><span>Availability:</span>
                                        @if ($product->quantity > 0)
                                            <span class="in-stock text-success">In Stock</span>
                                        @else
                                            <span class="out-stock text-danger">Out of Stock</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-quantity-box mb-30">
                                <div class="qty-boxx">
                                    @if ($product->quantity > 0)
                                    <form action="{{ route('cart.add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="btn-cart" type="submit">Add to Cart</button>
                                    </form>
                                    @else
                                    <button class="btn-cart" disabled type="button">Add to Cart</button>
                                    @endif
                                   
                                </div>
                            </div>
                            <div class="useful-links mb-20">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa fa-heart-o"></i>Add to Wishlist</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details wrapper end -->

    <!-- product description + reviews start -->
    <div class="product-details-reviews pb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-info mt-half">
                        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" id="nav_desctiption" data-bs-toggle="pill"
                                    data-bs-target="#tab_description" role="tab" aria-controls="tab_description"
                                    aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" id="nav_review" data-bs-toggle="pill"
                                    data-bs-target="#tab_review" role="tab" aria-controls="tab_review"
                                    aria-selected="false">Reviews (1)</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab_description" role="tabpanel"
                                aria-labelledby="nav_description">
                                {!! $product->description !!}
                            </div>

                            <div class="tab-pane fade" id="tab_review" role="tabpanel" aria-labelledby="nav_review">
                                <div class="product-review">
                                    <div class="customer-review">
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Sinrato Themes</strong></td>
                                                    <td class="text-end">09/04/2019</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <p>It’s both good and bad. If Nikon had achieved a high-quality wide
                                                            lens camera with a 1 inch sensor, that would have been a very
                                                            competitive product. So in that sense, it’s good for us. But
                                                            actually, from the perspective of driving the 1 inch sensor
                                                            market, we want to stimulate this market and that means multiple
                                                            manufacturers.</p>
                                                        <div class="product-ratings">
                                                            <ul class="ratting d-flex mt-2">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end of customer-review -->
                                    <form action="#" class="review-form">
                                        <h2>Write a review</h2>
                                        <div class="form-group row mb-3">
                                            <div class="col">
                                                <label class="col-form-label"><span class="text-danger">*</span> Your
                                                    Name</label>
                                                <input type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col">
                                                <label class="col-form-label"><span class="text-danger">*</span> Your
                                                    Review</label>
                                                <textarea class="form-control" required></textarea>
                                                <div class="help-block pt-10"><span class="text-danger">Note:</span> HTML is
                                                    not translated!</div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col">
                                                <label class="col-form-label"><span class="text-danger">*</span>
                                                    Rating</label>
                                                &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                <input type="radio" value="1" name="rating">
                                                &nbsp;
                                                <input type="radio" value="2" name="rating">
                                                &nbsp;
                                                <input type="radio" value="3" name="rating">
                                                &nbsp;
                                                <input type="radio" value="4" name="rating">
                                                &nbsp;
                                                <input type="radio" value="5" name="rating" checked>
                                                &nbsp;Good
                                            </div>
                                        </div>
                                        <div class="buttons d-flex justify-content-end">
                                            <button class="btn-cart rev-btn" type="submit">Continue</button>
                                        </div>
                                    </form> <!-- end of review-form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product description + reviews end -->

    <!--  start related-products -->
    <div class="related-product-area mb-40">
        <div class="container-fluid">
            <div class="section-title">
                <h3><span>Related</span> Products </h3>
            </div>
            <div class="flash-sale-active4 owl-carousel owl-arrow-style">
                @forelse ($relatedProducts as $key => $relatedProduct)
                    <div class="product-item mb-30">
                        <div class="product-thumb">
                            <a href="{{ route('product.detail', $relatedProduct->slug) }}">
                                @if ($relatedProduct->productImages->count() > 0)
                                    @forelse ($relatedProduct->productImages as $key => $image)
                                        <img src="{{ asset($image->image) }}" alt="" class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}">
                                    @empty
                                    @endforelse
                                @endif
                            </a>
                            <div class="box-label">
                                <div class="label-product label_new">
                                    <span>new</span>
                                </div>
                                <div class="label-product label_sale">
                                    @if ($relatedProduct->discount > 0)
                                        <span>-{{ $relatedProduct->discount }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="action-links">
                                <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                <a href="#" title="Quick view" data-bs-target="#quickk_view" data-bs-toggle="modal"><i
                                        class="lnr lnr-magnifier"></i></a>
                            </div>
                        </div>
                        <div class="product-caption">
                            <div class="manufacture-product">
                                <p><a href="{{ route('brand.product', $relatedProduct->brand->slug) }}">{{ $relatedProduct->brand->name }}</a></p>
                            </div>
                            <div class="product-name">
                                <h4><a
                                        href="{{ route('product.detail', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                </h4>
                            </div>
                            <div class="ratings">
                                <span class="yellow"><i class="lnr lnr-star"></i></span>
                                <span class="yellow"><i class="lnr lnr-star"></i></span>
                                <span class="yellow"><i class="lnr lnr-star"></i></span>
                                <span class="yellow"><i class="lnr lnr-star"></i></span>
                                <span class="yellow"><i class="lnr lnr-star"></i></span>
                            </div>
                            <div class="price-box">
                                @if ($relatedProduct->discount)
                                    <span class="regular-price"><span
                                            class="special-price">&#2547;{{ number_format($relatedProduct->discount_price) }}</span></span>
                                    <span class="old-price"><del>&#2547;{{ number_format($relatedProduct->price) }}</del></span>
                                @else
                                    <span class="old-price">&#2547;{{ number_format($relatedProduct->price) }}</span>
                                @endif
                            </div>
                            <form action="{{ route('cart.add')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                <button class="btn-cart" type="submit">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                @empty
                    No related products found.
                @endforelse
            </div>
        </div>
    </div>
    <!--  end related-products -->

@endsection