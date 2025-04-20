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
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Start cart Wrapper -->
    <div class="shopping-cart-wrapper pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="primary" class="site-main">
                        <div class="shopping-cart">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h3>Shopping Cart</h3>
                                    </div>
                                    <form action="#">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Image</td>
                                                        <td>Product</td>
                                                        <td>Quantity</td>
                                                        <td>Price</td>
                                                        <td>Total</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($cartItems as $key => $item)
                                                    @php
                                                    $total += $item['price'] * $item['quantity'];
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <img src="{{ $item['image'] ?? '' }}" alt="Image of {{ $item['name'] }}" title="{{ $item['name'] }}" class="img-thumbnail">
                                                        </td>
                                                        <td> {{ $item['name'] }} </td>
                                                        <td>
                                                            <input type="hidden" name="product_id" value="{{ $key }}">
                                                            <div class="d-flex">
                                                                <button type="submit" class="btn btn-sm btn-primary btn-decrement" data-id="{{ $key }}">-</button>
                                                                <input type="number" name="quantity" data-id="{{ $key }}" value="{{ $item['quantity'] }}" class="form-control w-25 mx-2 quantity">
                                                                <button type="submit" class="btn btn-sm btn-primary btn-increment" data-id="{{ $key }}">+</button>
                                                            </div>
                                                        </td>
                                                        <td>&#2547;{{ number_format($item['price']) }}</td>
                                                        <td>&#2547;{{ number_format($item['price'] * $item['quantity']) }}</td>
                                                        <td>
                                                            <form action="{{ route('cart.destroy', $key) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="product_id" value="{{ $key }}">
                                                                <button type="submit" class="btn btn-danger" title="Remove item" onclick="return confirm('Are you sure you want to remove this item from cart?')"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>

                                    <div class="cart-amount-wrapper">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Shipping:</strong></td>
                                                            <td><span class="color-primary">&#2547;100</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total:</strong></td>
                                                            <td>
                                                                <span class="color-primary">&#2547;{{ number_format($total + 100) }}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-button-wrapper d-flex justify-content-between mt-4">
                                        <a href="{{ route('products') }}" class="btn btn-secondary">Continue Shopping</a>
                                        <a href="checkout.html" class="btn btn-secondary dark align-self-end">Checkout</a>
                                    </div>
                                    {{-- <form action="{{ route('clear') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-cart" type="submit">Clear Cart</button>
                                    </form> --}}
                                </div>
                            </div>
                        </div> <!-- end of shopping-cart -->
                    </main> <!-- end of #primary -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>
    <!-- End cart Wrapper -->

@endsection

@push('custom_js')
    <script>
        $(document).ready(function () {
            $('.btn-decrement').click(function () {
                var productId = $(this).attr('data-id');
                let quantity = $('.quantity[data-id="' + productId + '"]').val();
                if (quantity > 1) {
                    quantity--;
                }
                $('.quantity[data-id="' + productId + '"]').val(quantity);

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method: "POST",
                    data: {
                        product_id: productId,
                        quantity_decrement: quantity,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        location.reload();
                    }
                })
            });

            $('.btn-increment').click(function () {
                var productId = $(this).attr('data-id');
                let quantity = $('.quantity[data-id="' + productId + '"]').val();
                quantity++;
                $('.quantity[data-id="' + productId + '"]').val(quantity);
                
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method: "POST",
                    data: {
                        product_id: productId,
                        quantity_increment: quantity,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        location.reload();
                    }
                })
            });
        });
    </script>
@endpush