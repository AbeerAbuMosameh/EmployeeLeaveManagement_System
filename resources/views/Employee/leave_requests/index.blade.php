@extends('Dashboard.master')
@section('title')
    Leave Requests
@endsection
@section('subTitle')
    Leave Requests
@endsection

@section('Page-title')
    Leave Requests
@endsection

@section('js')
    <script type="text/javascript">
        $("#msg").show().delay(3000).fadeOut();
    </script>

    <script>
        function sweets(id, reference) {
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
                        url: '/employee/leaves_request/' + id,
                        method: 'DELETE',
                        data: {_token: '{{ csrf_token() }}'},
                        success: function (response) {
                            reference.closest('tr').remove();
                            // Show the success message
                            Swal.fire(
                                'Deleted!',
                                'Your Leave Requests has been deleted.',
                                'success'
                            );
                        },
                        error: function (xhr, status, error) {
                            // Show the error message
                            Swal.fire(
                                'Error!',
                                'There was an error deleting company.',
                                'error'
                            );
                        }
                    });
                }
            });

        }


    </script>

@endsection
@section('content')

    <div class="flex-lg-row-fluid ms-lg-10">
        <!--begin::Card-->
        <div class="card card-flush mb-6 mb-xl-9">

            <div class="card-body pt-0">
                @can('leaves-request-list')
                    <div class="card card-custom">

                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Leave Requests List </h3>
                            </div>
                            @can('leaves-request-list')
                                <div class="card-toolbar">
                                    <a href="{{route('leaves_request.create')}}"
                                       class="btn btn-sm btn-light-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                       data-bs-target="#kt_modal_new_target">
                                        <i class="la la-plus"></i> Create new Leave Requests
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
                                    <th>Leave Type</th>
                                    <th>Duration</th>
                                    <th>Duration Unit</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Leave Reason</th>
                                    <th>status</th>
                                    <th>Deny Reason</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($leave_requests as $leave_request)
                                    <tr data-entry-id="{{ $leave_request->id }}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$leave_request->leave_type}}</td>
                                        <td>{{$leave_request->duration}}</td>
                                        <td>{{$leave_request->duration_unit}}</td>
                                        <td>{{$leave_request->start_date}}</td>
                                        <td>{{$leave_request->end_date}}</td>
                                        <td>{{$leave_request->leave_reason}}</td>

                                        @if($leave_request->status == 'pending')
                                            <td data-field="Status" data-autohide-disabled="false" aria-label="3"
                                                class="datatable-cell"><span style="width: 108px;"><span
                                                        class="label font-weight-bold label-lg  label-light-warning label-inline">Pending</span></span>
                                            </td>
                                        @elseif($leave_request->status == 'approved')
                                            <td data-field="Status" data-autohide-disabled="false" aria-label="2"
                                                class="datatable-cell"><span style="width: 108px;"><span
                                                        class="label font-weight-bold label-lg  label-light-primary label-inline">Approved</span></span>
                                            </td>
                                        @else
                                            <td data-field="Status" data-autohide-disabled="false" aria-label="2"
                                                class="datatable-cell"><span style="width: 108px;"><span
                                                        class="label font-weight-bold label-lg  label-light-danger label-inline">Denied</span></span>
                                            </td>
                                        @endif

                                        <td>{{$leave_request->deny_reason ?? '--'}}</td>
                                        <td>
                                            @if($leave_request->status == 'pending')
                                                @can('leaves-request-list')
                                                    <a href="{{ route('leaves_request.edit', $leave_request->id) }}"
                                                       class="btn btn-sm btn-clean btn-icon"
                                                       title="Edit details">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                @endcan
                                            @endif
                                            @can('leaves-request-list')
                                                <a onclick="sweets('{{$leave_request->id}}',this)"
                                                   class="btn btn-sm btn-clean btn-icon btn-delete " title="Delete">
                                                    <i class="nav-icon la la-trash"></i>
                                                </a>
                                            @endcan
                                        </td>
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

@endsection

