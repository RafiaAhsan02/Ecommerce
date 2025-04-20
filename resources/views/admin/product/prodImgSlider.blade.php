<div class="slider-area">
    <div class="hero-slider-active slick-dot-style slider-arrow-style">
        {{-- @forelse($product->productImages as $key => $image) --}}
        <div class="single-slider d-flex align-items-center">
            {{-- style="background-image: url({{ asset($image->image) }});" --}}
            <div class="col-md-6 text-center">
                {{-- <img src="{{ asset('assets/backend/img/examples/example9-300x300.jpg') }}" alt="" width="350"
                    height="350"> --}}
            </div>
        </div>
        {{-- @empty
        @endforelse --}}
    </div>
</div>