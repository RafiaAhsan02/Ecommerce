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
                <a href="{{ route('admin.slider.index') }}">Slider</a>
            </li>
        </ul>
        <div>
            <a href="{{ route('admin.slider.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Edit Slider</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($slider)
                            @method('put')
                        @endisset
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title<strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $slider->title ?? old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sub_title" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title"
                                        value="{{ $slider->sub_title ?? old('sub_title') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="url" class="form-label">Slider URL/Link (Product link)<strong class="text-danger">*</strong></label>
                                    <input type="url" class="form-control" id="url" name="url" value="{{ $slider->url ?? old('url') }}">
                                </div>
                                @error('url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Image<strong
                                            class="text-danger">*</strong></label>
                                    <input type="file" class="form-control dropify" data-max-file-size="2M" data-default-file="{{ asset($slider->image) }}" id="image"
                                        name="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Status<strong class="text-danger">*</strong></label>
                                    <div class="form-check pb-1">
                                        <input class="form-check-input" type="radio" @checked($slider->status == true) name="status" id="active" value="1">
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check pt-1">
                                        <input class="form-check-input" type="radio" @checked($slider->status == false) name="status" id="inactive" value="0">
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('page_css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/dropify/dist/css/dropify.min.css') }}">
@endpush

@push('page_js')
    <script src="{{ asset('assets/backend/vendor/dropify/dist/js/dropify.min.js') }}"></script>
@endpush

@push('custom_js')
    <script>
        // Dropify
        $('.dropify').dropify({
            height: 120,
        });
    </script>
@endpush