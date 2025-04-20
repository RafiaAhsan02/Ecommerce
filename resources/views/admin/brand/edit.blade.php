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
                <a href="{{ route('admin.brand.index') }}">Brands</a>
            </li>
        </ul>
        <div>
            <a href="{{ route('admin.brand.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Edit Brand</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($brand)
                        @method('PUT')
                        @endisset

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name ?? old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $brand->slug ?? old('slug') }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Brand Logo<strong class="text-danger">*</strong></label>
                                    <input type="file" class="form-control dropify" data-max-file-size="2M" data-default-file="{{ asset($brand->image) }}" id="image" name="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>

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
        $(document).ready(function () {
            $('#name').keyup(function () {
                let name = $(this).val();
                $('#slug').val(slugify(name));
            });
        });

        function slugify(text) {
            return text.toString().toLowerCase().trim()
                .replace(/&/g, '-and-')
                .replace(/[\s\W-]+/g, '-')
                .replace(/-+$/, '')
        }
        // Dropify
        $('.dropify').dropify({
            height: 120,
        });
    </script>
@endpush