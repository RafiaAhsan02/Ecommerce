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
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add Product</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Product List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="product" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name ?? '' }}</td>
                                        <td>{{ $product->brand->name ?? '' }}</td>
                                        <td>
                                            {{-- HTML entity for taka: &#2547 --}}
                                            @if ($product->discount != null)
                                                <del class="text-danger">&#2547;{{ number_format($product->price) }}</del> <br>
                                                <span class>&#2547;{{ number_format($product->discount_price) }} ({{ $product->discount }}%)</span>
                                            @else
                                                &#2547;{{ number_format($product->price) }}
                                            @endif
                                        </td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if($product->is_featured == true)
                                                <span class="badge badge-primary">Featured</span>
                                            @else
                                                <span class="badge badge-info">Regular</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->deleted_at == true)
                                                <span class="badge badge-danger">Trashed</span>
                                            @elseif($product->status == true)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->deleted_at == true)
                                                <a href="{{ route('admin.product.restore', $product->id) }}"
                                                    class="btn btn-sm btn-secondary" title="Restore product">
                                                    <i class="fa fa-recycle"></i></a>

                                                <button onclick="deleteRecord({{ $product->id }})" type="button"
                                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                                    title="Delete product">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $product->id }}"
                                                    action="{{ route('admin.product.destroy', $product->id) }}" method="post"
                                                    style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <a href="{{ route('admin.product.show', $product->id) }}"
                                                    class="btn btn-sm btn-primary" title="View product">
                                                    <i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                                    class="btn btn-sm btn-success" title="Edit product">
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="{{ route('admin.product.trash', $product->id) }}"
                                                    class="btn btn-sm btn-warning" title="Trash product"
                                                    onclick="return confirm('Are you sure you want to move this product to trash?')">
                                                    <i class="fa fa-trash-alt"></i></a>
                                            @endif


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
            $("#product").DataTable({});
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
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your file is safe :)",
                        icon: "error"
                    });*/
                }
            });
        }
    </script>
@endpush