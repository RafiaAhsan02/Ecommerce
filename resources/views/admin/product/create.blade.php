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
                    <h4 class="card-title">Create Product</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug<strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Short Description<strong
                                            class="text-danger">*</strong></label>
                                    <textarea class="form-control" id="short_description" name="short_description"
                                        rows="4">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Product Description<strong
                                            class="text-danger">*</strong></label>
                                    <textarea class="form-control" id="description"
                                        name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price<strong
                                                    class="text-danger">*</strong></label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                value="{{ old('price') }}" min="0">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Quantity<strong
                                                    class="text-danger">*</strong></label>
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                value="{{ old('quantity') }}" min="0">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="discount" class="form-label">Discount(%)</label>
                                            <input type="number" class="form-control" id="discount" name="discount"
                                                value="{{ old('discount') }}" min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="discount_price" class="form-label">Discounted Price</label>
                                            <input type="number" class="form-control" id="discount_price"
                                                name="discount_price" value="{{ old('discount_price') }}" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Select Category<strong
                                            class="text-danger">*</strong></label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        @error('category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="subCategory" class="form-label">Select Subcategory</label>
                                    <select name="subCategory" id="subCategory" class="form-select">
                                        {{-- data pushed using ajax --}}
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="brand" class="form-label">Select Brand<strong
                                            class="text-danger">*</strong></label>
                                    <select name="brand" id="brand" class="form-select">
                                        <option value="" selected disabled>Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                        @error('brand')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="images" class="form-label">Upload Product Images<strong
                                            class="text-danger">*</strong></label>
                                    <input type="file" class="form-control" multiple id="images" name="images[]">
                                    @error('images')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Featured:</label>
                                    <div class="form-check pb-1">
                                        <input class="form-check-input" type="radio" name="is_featured" id="yes" value="1">
                                        <label class="form-check-label" for="yes">Yes</label>
                                    </div>
                                    <div class="form-check pt-1">
                                        <input class="form-check-input" type="radio" name="is_featured" id="no" value="0"
                                            checked>
                                        <label class="form-check-label" for="no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Status:</label>
                                    <div class="form-check pb-1">
                                        <input class="form-check-input" type="radio" name="status" id="published" value="1">
                                        <label class="form-check-label" for="published">Published</label>
                                    </div>
                                    <div class="form-check pt-1">
                                        <input class="form-check-input" type="radio" name="status" id="draft" value="0"
                                            checked>
                                        <label class="form-check-label" for="draft">Draft</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('page_css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/summernote/summernote.min.css') }}">
@endpush

@push('page_js')
    <script src="{{ asset('assets/backend/vendor/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/summernote/summernote.min.js') }}"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function () {
            /* activate summernote */
            $('#description').summernote({
                placeholder: 'Product description goes here...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'help']]
                ]
            });

            // Dropify
            $('.dropify').dropify({
                height: 120,
            });

            /* autofill slug using name */
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

        $('#category').change(function () {
            let category_id = $(this).val();
            $.ajax({
                url: "{{ route('admin.get.subcategory') }}",
                type: "GET",
                data: {
                    category_id: category_id
                },
                success: function (data) {
                    $('#subCategory').html(data);
                }
            });
        });

        $('#discount').keyup(function () {
            let discount = $(this).val();
            let price = $('#price').val();
            let discount_price = price - (price * discount) / 100;
            if (discount_price > 0) {
                $('#discount_price').val(discount_price);
            } else {
                $('#discount_price').val('');

            }
        });

        $('#price').keyup(function () {
            $('#discount_price').val('');
        });

    </script>
@endpush