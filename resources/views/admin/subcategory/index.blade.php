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
                <a href="{{ route('admin.subcategory.index') }}">Subcategories</a>
            </li>
        </ul>
        <div>
            <a href="{{ route('admin.subcategory.create') }}" class="btn btn-primary">Add Subcategory</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Subcategory List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="subcategory" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subCategories as $key => $subCategory)
                                    <tr>                                        
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>{{ $subCategory->slug }}</td>
                                        <td>{{ $subCategory->category->name??'' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($subCategory->created_at)->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.subcategory.edit', $subCategory->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            <button onclick="deleteRecord({{ $subCategory->id }})" type="button"
                                                class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                                title="Delete Category">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $subCategory->id }}"
                                                action="{{ route('admin.subcategory.destroy', $subCategory->id) }}" method="post"
                                                style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

{{-- Datatables --}}
@push('page_js')
    <script src="{{ asset('assets/backend/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function () {
            $("#subcategory").DataTable({});
        })
    </script>

    <script>
        function deleteRecord(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value) {
                        $('#delete-form-' + id).submit();
                    }
                    /*swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });*/
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your file is safe :)",
                        icon: "error"
                    });
                }
            });
        }
    </script>
@endpush