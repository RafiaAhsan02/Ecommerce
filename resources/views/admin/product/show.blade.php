@extends('layouts.backend.master')

@section('content')

    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.product.index') }}">Products</a>
            </li>
        </ul>
        <div>
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Product Details</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h5 class="mb-3">
                                {{ $product->category->name ?? '' }}
                                @if ($product->subCategory)
                                    > {{ $product->subCategory->name}}
                                @endif
                            </h5>
                            <h2>{{ $product->name }}</h2>

                            {{-- Status Badge --}}
                            @if($product->status == true)
                                <span class="badge badge-success">Published</span>
                            @else
                                <span class="badge badge-secondary">Draft</span>
                            @endif

                            {{-- Featured Badge --}}
                            @if($product->is_featured == true)
                                <span class="badge badge-primary">Featured</span>
                            @else
                                <span class="badge badge-info">Regular</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3 pb-5">
                        <div class="col-md-6 text-center">
                            {{-- @include('admin.product.prodImgSlider') --}}
                            <img src="{{ asset('assets/backend/img/examples/example9-300x300.jpg') }}" alt="" width="350" height="350">
                        </div>

                        <div class="col-md-5">
                            <div class="box">
                                <h5 class="mb-3">Product Specifications</h5>
                                <p><strong>Brand:</strong> {{ $product->brand->name }}</p>
                                <p><strong>Short Description:</strong> {{ $product->short_description }}</p>
                                <div class="pricing">
                                    @if ($product->discount)
                                        <p class="old-price"><strong>Regular Price:</strong>
                                            <del class="text-danger">&#2547;{{ number_format($product->price) }}</del>
                                            <span>(-{{ $product->discount }}%)</span>
                                        </p>

                                        <p class="regular-price">
                                            <span class="special-price"><strong>Sale Price:</strong>
                                                &#2547;{{ number_format($product->discount_price) }}
                                            </span>
                                        </p>
                                    @else
                                        <span class="regular-price"><strong>Price:</strong> &#2547;{{ number_format($product->price) }}</span>
                                    @endif
                                </div>
                                <p>
                                    <strong>Availability:</strong>
                                        @if ($product->quantity > 0)
                                            <span class="in-stock text-success">In Stock</span>
                                            <span>({{ $product->quantity }})</span>
                                        @else
                                            <span class="out-stock text-danger">Out of Stock</span>
                                        @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row mb-3 pt-3 px-3">
                        <h5 class="mb-3"><strong>Product Description</strong></h5>
                        <div class="description">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page_css')
@endpush

@push('page_js')
@endpush

@push('custom_js')
<script>
</script>
@endpush