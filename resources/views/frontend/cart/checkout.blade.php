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
                                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="container-fluid mb-3 d-flex checkout-head">
        <h2>Checkout</h2>

        <div class="cart-button-wrapper">
            <a href="{{ route('cart.index') }}" class="btn btn-secondary dark">Back to Cart</a>
        </div>
    </div>

    <!-- Start of Checkout Wrapper -->
    <div class="checkout-wrapper pt-10 pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <main id="primary" class="site-main">

                        <div class="checkout-area">
                            <form action="{{ route('checkout.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-7">
                                        <div class="checkout-form">
                                            <div class="section-title left-aligned">
                                                <h3>Billing Details</h3>
                                            </div>

                                            <div class="row g-2 mb-3">
                                                <div class="mb-3 col-12 col-sm-12">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ Auth::user()->name ?? '' }}" required>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="row g-2 mb-3">

                                                <div class="mb-3 col-12 col-sm-12">
                                                    <label for="email_address">Email Address <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ Auth::user()->email ?? '' }}" id="email_address" readonly
                                                        required>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="mb-3 col-12 col-sm-12">
                                                    <label for="phone">Mobile Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="phone" id="phone"
                                                        value="{{ Auth::user()->phone ?? '' }}" required>
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="mb-3 col-12">
                                                    <label for="address">Address <span class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control" rows="5" name="address"
                                                        id="address" required>{{ Auth::user()->address ?? '' }}</textarea>
                                                    </textarea>
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="form-group col-12">
                                                    <label for="order_notes">Order Notes</label>
                                                    <textarea class="form-control" rows="5" id="order_notes"
                                                        name="order_note"
                                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end of checkout-form -->
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 col-lg-5">
                                        <div class="order-summary">
                                            <div class="section-title left-aligned">
                                                <h3>Your Order</h3>
                                            </div>
                                            <div class="product-container">
                                                @php
                                                    $cartItems = session()->get('cart', []);
                                                    $total = 0;
                                                @endphp
                                                @if (count($cartItems) > 0)
                                                    @foreach ($cartItems as $key => $item)
                                                        @php
                                                        $total += $item['price'] * $item['quantity'];
                                                        @endphp
                                                        <div class="product-list">
                                                            <div class="product-inner d-flex align-items-center">
                                                                <div class="product-image me-4 me-sm-5 me-md-4 me-lg-5">
                                                                    <a href="#">
                                                                        <img src="{{ $item['image'] ?? '' }}" alt="Image of {{ $item['name'] }}" title="{{ $item['name'] }}">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>{{ $item['name'] }}</h5>
                                                                    <p class="product-quantity">Quantity:
                                                                        {{ $item['quantity'] }}
                                                                    </p>
                                                                    <p class="product-final-price">
                                                                        ৳{{ number_format($item['price'] * $item['quantity']) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif


                                            </div> <!-- end of product-container -->
                                            <div class="order-review">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr class="cart-subtotal">
                                                                <th>Shipping Charge</th>
                                                                <td class="text-center">৳100</td>
                                                            </tr>

                                                            <tr class="order-total">
                                                                <th>Total</th>
                                                                <td class="text-center">
                                                                    <strong>৳{{ number_format($total + 100) }}</strong>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="checkout-payment">

                                                <div class="form-row">
                                                    <div class="custom-radio">
                                                        <input class="form-check-input" type="radio" name="payment_method"
                                                            id="cash_delivery_payment" value="cash" required>
                                                        <span class="checkmark"></span>
                                                        <label class="form-check-label" for="cash_delivery_payment">Cash
                                                            on Delivery</label>

                                                        <div class="payment-info" id="cash_pay">
                                                            <p>Pay with cash upon delivery.</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="custom-radio">
                                                        <input class="form-check-input" type="radio" name="payment_method"
                                                            id="ssl_payment" value="online">
                                                        <span class="checkmark"></span>
                                                        <label class="form-check-label" for="ssl_payment">Online
                                                            Payment</label>

                                                        <div class="payment-info" id="paypal_pay">
                                                            <p>Pay via SSL Payment Gateway. You can pay with your credit
                                                                card or mobile banking.</p>
                                                        </div>

                                                        @error('payment_method')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-check">
                                                        <div class="custom-checkbox">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="terms_acceptance" required>
                                                            <span class="checkmark"></span>
                                                            <label class="form-check-label" for="terms_acceptance">I
                                                                agree to the <a href="#">terms of service</a> and will
                                                                adhere to them unconditionally.</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row text-center">
                                                    <input type="submit" class="btn btn-secondary dark" value="Continue to Payment">
                                                </div>
                                            </div> <!-- end of checkout-payment -->
                                        </div> <!-- end of order-summary -->
                                    </div>
                                </div> <!-- end of row -->
                            </form>
                        </div> <!-- end of checkout-area -->
                    </main> <!-- end of #primary -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>
    <!-- End of Checkout Wrapper -->

@endsection

@push('custom_js')
    <script>
        $(document).ready(function () {

            $('input[type="radio"]').click(function () {
                if ($(this).attr("value") == "cash") {
                    $("#cash_pay").show();
                    $("#paypal_pay").hide();
                } else if ($(this).attr("value") == "online") {
                    $("#cash_pay").hide();
                    $("#paypal_pay").show();
                }
            });

            $('#phone').on('keyup', function () {
                var checknumber = $('#phone').val();
                $('#phone').val(checknumber.replace(/\D/g, ''));
            })

        });
    </script>
@endpush