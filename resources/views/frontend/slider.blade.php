<div class="slider-area">
    <div class="hero-slider-active slick-dot-style slider-arrow-style">
        @forelse($sliders as $key => $slider)

            <div class="single-slider d-flex align-items-center"
                style="background-image: url({{ asset($slider->image) }});">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-sm-8">
                            <div class="slider-text">
                                <h1>{!! $slider->title !!}</h1>
                                <p>{{ $slider->sub_title }}</p>
                                <a class="btn-1 home-btn" href="{{ $slider->url??'#' }}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty

        @endforelse

    </div>
</div>