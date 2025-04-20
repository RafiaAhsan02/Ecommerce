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
            <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">Add Slider</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Slider Images</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="slider" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sliders as $key => $slider)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a href="{{ $slider->url ?? '#' }}" target="_blank">{{ $slider->title }}</a>
                                        </td>
                                        <td>{{ $slider->sub_title ?? '(none)' }}</td>
                                        <td>
                                            <img width="100" src="{{ asset($slider->image) }}" alt="{{ $slider->name }}">
                                        </td>
                                        <td>
                                            @if($slider->deleted_at == true)
                                                <span class="badge badge-danger">Trashed</span>
                                            @elseif($slider->status == true)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($slider->deleted_at == true)
                                                <a href="{{ route('admin.slider.restore', $slider->id) }}"
                                                    class="btn btn-sm btn-secondary" title="Restore slider">
                                                    <i class="fa fa-recycle"></i></a>

                                                <button onclick="deleteRecord({{ $slider->id }})" type="button"
                                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                                    title="Delete slider">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $slider->id }}"
                                                    action="{{ route('admin.slider.destroy', $slider->id) }}" method="post"
                                                    style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                                    class="btn btn-sm btn-success" title="Edit slider">
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="{{ route('admin.slider.trash', $slider->id) }}"
                                                    class="btn btn-sm btn-warning" title="Trash slider"
                                                    onclick="return confirm('Are you sure you want to move this slider to trash?')">
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
            $("#slider").DataTable({});
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