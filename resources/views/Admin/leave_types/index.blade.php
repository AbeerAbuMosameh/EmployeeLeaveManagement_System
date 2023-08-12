@extends('Dashboard.master')
@section('title')
    Leave Types
@endsection
@section('subTitle')
    Leave Types
@endsection

@section('Page-title')
    Leave Types

@endsection

@section('content')
    <div class="flex-lg-row-fluid ms-lg-10">
        <div class="card card-flush mb-6 mb-xl-9">
            <div class="card-body pt-0">
                @can('leaves-list')
                    <div class="card card-custom">

                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label"> Leave Types List </h3>
                            </div>
                            @can('leaves-create')
                                <div class="card-toolbar">
                                    <a href="{{route('leaves_type.create')}}"
                                       class="btn btn-sm btn-light-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                       data-bs-target="#kt_modal_new_target" data-toggle="modal"
                                       data-target="#exampleModal">
                                        <i class="la la-plus"></i> Create new Leave Types
                                    </a>
                                </div>
                            @endcan

                        </div>

                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leave_types as  $leave_type)
                                    <tr data-entry-id="{{ $leave_type->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $leave_type->name ?? '' }}</td>
                                        <td>{{ $leave_type->description ?? '' }}</td>
                                        <td>
                                            @can('leaves-edit')
                                                <a href="{{ route('leaves_type.edit', $leave_type->id) }}"
                                                   class="btn btn-sm btn-clean btn-icon" data-bs-toggle="modal"
                                                   data-bs-target="#kt_modal_new_target" data-toggle="modal"
                                                   data-target="#editModal_{{ $leave_type->id }}" title="Edit details">
                                                    <i class="la la-edit"></i>

                                                </a>
                                            @endcan
                                            @can('leaves-delete')
                                                <a onclick="sweet('{{$leave_type->id}}',this)"
                                                   class="btn btn-sm btn-clean btn-icon btn-delete " title="Delete">
                                                    <i class="nav-icon la la-trash"></i>
                                                </a>
                                            @endcan
                                        </td>
                                        <form method="POST" action="{{ route("leaves_type.update", $leave_type->id) }}" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal fade" id="editModal_{{ $leave_type->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Leave Type</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row pt-4">
                                                                <div class="col-lg-12">
                                                                    <label for="name">Name<span class="text-danger">*</span></label>
                                                                    <x-input name="name" type="text" value="{{$leave_type->name}}" placeholder="Enter Name"></x-input>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row pt-4">
                                                                <div class="col-lg-12">
                                                                    <label for="name">Description</label>
                                                                    <x-input name="description" type="text" value="{{$leave_type->description}}" placeholder="Enter Description"></x-input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                                                                Close
                                                            </button>

                                                            @can('leaves-edit')
                                                                <button type="submit" class="btn btn-primary font-weight-bold">
                                                                    <span class="indicator-label">Edit</span>
                                                                </button>
                                                            @endcan

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>
                @endcan
            </div>

        </div>

    </div>

    <!-- Button trigger modal-->

    <!-- Modal-->
    <form method="POST" action="{{ route("leaves_type.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Leave Types</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row pt-4">
                            <div class="col-lg-12">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <x-input name="name" type="text" value="" placeholder="Enter Name"></x-input>
                            </div>
                        </div>

                        <div class="form-group row pt-4">
                            <div class="col-lg-12">
                                <label for="name">Description</label>
                                <x-input name="description" type="text" value="" placeholder="Enter Description"></x-input>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close
                        </button>

                        @can('leaves-create')
                            <button type="submit" class="btn btn-primary font-weight-bold">
                                <span class="indicator-label">Save</span>
                            </button>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </form>



@endsection
@section('js')
    <script>
        function sweet(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/superAdmin/leaves_type/' + id,
                        method: 'DELETE',
                        data: {_token: '{{ csrf_token() }}'},
                        success: function (response) {
                            reference.closest('tr').remove();
                            // Show the success message
                            Swal.fire(
                                'Deleted!',
                                'Your team has been deleted.',
                                'success'
                            );
                        },
                        error: function (xhr, status, error) {
                            console(error);
                            // Show the error message
                            Swal.fire(
                                'Error!',
                                'There was an error deleting team.',
                                'error'
                            );
                        }
                    });
                }
            });

        }


    </script>

@endsection


