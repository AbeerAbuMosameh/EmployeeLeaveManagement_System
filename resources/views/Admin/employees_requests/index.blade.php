@extends('Dashboard.master')
@section('title')
    Employees Leave Request
@endsection
@section('subTitle')
    Employees Leave Request
@endsection

@section('Page-title')
    Employees Leave Request

@endsection

@section('content')
    <div class="flex-lg-row-fluid ms-lg-10">
        <div class="card card-flush mb-6 mb-xl-9">
            <div class="card-body pt-0">
                @can('employees-leaves-request-list')
                    <div class="card card-custom">

                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label"> Employees Leave Request List</h3>
                            </div>

                        </div>

                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Duration</th>
                                    <th>Duration Unit</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Leave Reason</th>
                                    <th>status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees_requests as $employees_request)
                                    <tr data-entry-id="{{ $employees_request->id }}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$employees_request->employee->name}}</td>
                                        <td>{{$employees_request->leave_type}}</td>
                                        <td>{{$employees_request->duration}}</td>
                                        <td>{{$employees_request->duration_unit}}</td>
                                        <td>{{$employees_request->start_date}}</td>
                                        <td>{{$employees_request->end_date}}</td>
                                        <td>{{$employees_request->leave_reason}}</td>
                                        @if($employees_request->status == 'pending')
                                            <td data-field="Status" data-autohide-disabled="false" aria-label="3"
                                                class="datatable-cell"><span style="width: 108px;"><span
                                                        class="label font-weight-bold label-lg  label-light-warning label-inline">Pending</span></span>
                                            </td>
                                        @elseif($employees_request->status == 'approved')
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

                                        <td>
                                            @if($employees_request->status == 'pending')
                                                @can('employees-leaves-request-edit')
                                                    <a href="{{ route('leaves_request.edit', $employees_request->id) }}"
                                                       class="btn btn-sm btn-clean btn-icon" data-bs-toggle="modal"
                                                       data-bs-target="#kt_modal_new_target" data-toggle="modal"
                                                       data-target="#editModal_{{ $employees_request->id }}"
                                                       title="Edit details">
                                                        <i class="la la-edit"></i>

                                                    </a>

                                                    <form method="POST"
                                                          action="{{ route("employee_requests.update", $employees_request->id) }}"
                                                          enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="modal fade" id="editModal_{{ $employees_request->id }}"
                                                             tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">Change Status of
                                                                            Request</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="form-group row pt-4">
                                                                            <div class="col-lg-12">
                                                                                <label for="status">Status<span class="text-danger">*</span></label>
                                                                                <div class="input-group">
                                                                                    <select required
                                                                                            class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                                                                            name="status" id="status">
                                                                                        <option value="" disabled selected>Select
                                                                                            Status
                                                                                        </option>
                                                                                        <option
                                                                                            value="denied" {{ old('status') === 'denied' ? 'selected' : '' }}>
                                                                                            Deny
                                                                                        </option>
                                                                                        <option
                                                                                            value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>
                                                                                            Approved
                                                                                        </option>
                                                                                    </select>
                                                                                    @if($errors->has('status'))
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $errors->first('status') }}
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row pt-4">
                                                                            <div class="col-lg-12">
                                                                                <label for="deny_reason">Reason </label>
                                                                                <x-input name="deny_reason" id="deny_reason"
                                                                                         type="text"
                                                                                         value="{{$employees_request->deny_reason}}"
                                                                                         placeholder="Deny Reason"></x-input>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-light-primary font-weight-bold"
                                                                                data-dismiss="modal">
                                                                            Close
                                                                        </button>

                                                                        @can('employees-leaves-request-edit')
                                                                            <button type="submit"
                                                                                    class="btn btn-primary font-weight-bold">
                                                                                <span class="indicator-label">Edit</span>
                                                                            </button>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                @endcan


                                            @endif

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

@section('js')
    <script>
        $(document).ready(function () {
            $('#status').change(function () {
                var selectedStatus = $(this).val();
                if (selectedStatus === 'denied') {
                    $('#deny_reason').prop('required', true);
                } else {
                    $('#deny_reason').prop('required', false);
                }
            });
        });
    </script>
@endsection


