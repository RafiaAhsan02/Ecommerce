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
                <a href="{{ route('admin.approved.orders') }}">Approved Orders</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Order List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="category" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>Total Amount</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            
                                @forelse ($orders as $key => $order)
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name??'' }}</td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>
                                        <a href="{{ route('admin.show.order', $order->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                    </td>
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
            $("#category").DataTable({});
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