@extends('layouts.backend.master')

@section('content')
    {{-- <div class="page-header">
        <h4 class="page-title">Dashboard | Category</h4>
    </div> --}}

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
                <a href="{{ route('admin.category.index') }}">Categories</a>
            </li>
        </ul>
        <div>
            <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Create Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
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
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('page_js')
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
    </script>
@endpush