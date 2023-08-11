@extends('Dashboard.master')
@section('title')
    Employees
@endsection
@section('subTitle')
    Employees
@endsection

@section('Page-title')
    Employees
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
                            url: '/superAdmin/employees/' + id,
                            method: 'DELETE',
                            data: {_token: '{{ csrf_token() }}'},
                            success: function (response) {
                                reference.closest('tr').remove();
                                // Show the success message
                                Swal.fire(
                                    'Deleted!',
                                    'Your Employee has been deleted.',
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
                @can('employees-list')
                    <div class="card card-custom">

                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Employee List </h3>
                            </div>
                            @can('employees-create')
                                <div class="card-toolbar">
                                    <a href="{{route('employees.create')}}"
                                       class="btn btn-sm btn-light-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                       data-bs-target="#kt_modal_new_target">
                                        <i class="la la-plus"></i> Create new Employee
                                    </a>

                                    <!--end::Button-->
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr data-entry-id="{{ $employee->id }}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>@if ($employee->image)
                                                <img class="pr-4" src="{{asset($employee->image)}}" height="50px"
                                                     width="50px"
                                                     alt="Logo">
                                            @endif </td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->phone}}</td>
                                        <td>{{$employee->date_of_birth}}</td>
                                        <td>{{$employee->gender}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td>{{$employee->department}}</td>
                                        <td>
                                            @can('employees-edit')
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                   class="btn btn-sm btn-clean btn-icon"
                                                   title="Edit details">
                                                    <i class="la la-edit"></i>
                                                </a>
                                            @endcan
                                            @can('employees-delete')
                                                <a onclick="sweets('{{$employee->id}}',this)"
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

