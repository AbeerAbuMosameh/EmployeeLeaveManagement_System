@extends('Dashboard.master')

@section('title')
    Companies
@endsection
@section('Page-title')
    Companies
@endsection
@section('js')
    <script>
        var avatar1 = new KTImageInput('kt_image_5');
    </script>

@endsection
@section('content')
    <div class="col-12">
        <div class="card mb-6">
            <div class="card-body">
                @can('employees-edit')
                    <form method="POST" action="{{ route("employees.update", $employee) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">

                            <div class="col-lg-12">
                                <div style="text-align: center">
                                    <div class="image-input image-input-empty image-input-outline" id="kt_image_5"
                                         style="background-image: url('{{ $employee->image ? asset($employee->image) : asset('admin/assets/media/users/blank.png') }}')">
                                        <div class="image-input-wrapper"></div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Employee Image">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                        </label>
                                        <span
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="cancel" data-toggle="tooltip" title="Remove Image">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                        <span
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="remove" data-toggle="tooltip" title="Remove Employee Image">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row pt-4">
                            <div class="col-lg-6">
                                <label for="name">Name<span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <x-input-group icon="flaticon2-user"></x-input-group>
                                    <x-input name='name' type='text' value='{{ $employee->name }}' placeholder="Enter Name" ></x-input>

                                </div>


                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon2-new-email"></x-input-group>
                                    <x-input name='email' type='email' value='{{ $employee->email }}' placeholder="Enter Email" ></x-input>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row pt-4">
                            <div class="col-lg-6">
                                <label for="address">Address<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <x-input-group icon="la la-map-marker"></x-input-group>
                                    <x-input  name='address' type='text' value='{{ $employee->address }}' placeholder="Enter Address"></x-input>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon2-phone"></x-input-group>
                                    <x-input name='phone' type='email' value='{{ $employee->phone }}' placeholder="Enter Phone" ></x-input>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row pt-4">
                            <div class="col-lg-6">
                                <label for="phone">Birthday Date<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon2-calendar"></x-input-group>
                                    <x-input name='date_of_birth' type='date' value='{{ $employee->date_of_birth }}' placeholder="Enter Date of Birth" ></x-input>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="department">Department</label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon2-file"></x-input-group>
                                    <select class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}"
                                            name="department" id="department">
                                        <option value="">Select Department</option>
                                        <option value="hr" {{ old('department' , $employee->department) === 'hr' ? 'selected' : '' }}>HR
                                        </option>
                                        <option value="sales" {{ old('department', $employee->department) === 'sales' ? 'selected' : '' }}>
                                            Sales
                                        </option>
                                        <option
                                            value="marketing" {{ old('department', $employee->department) === 'marketing' ? 'selected' : '' }}>
                                            Marketing
                                        </option>
                                        <option value="it" {{ old('department', $employee->department) === 'it' ? 'selected' : '' }}>IT
                                        </option>
                                        <option value="finance" {{ old('department', $employee->department) === 'finance' ? 'selected' : '' }}>
                                            Finance
                                        </option>
                                        <option
                                            value="operations" {{ old('department', $employee->department) === 'operations' ? 'selected' : '' }}>
                                            Operations
                                        </option>
                                        <option
                                            value="research" {{ old('department', $employee->department) === 'research' ? 'selected' : '' }}>
                                            Research
                                        </option>
                                    </select>
                                </div>
                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('department') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row pt-4">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Gender</label>
                                    <div class="col-9 col-form-label">
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" name="gender" value="male" {{ old('gender', $employee->gender) === 'male' ? 'checked' : '' }}>
                                                <span></span>
                                                Male
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="gender" value="female" {{ old('gender', $employee->gender) === 'female' ? 'checked' : '' }}>
                                                <span></span>
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('gender'))
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $errors->first('gender') }}
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    @can('employees-create')
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">update</span>
                                        </button>
                                    @endcan
                                    <a type="button" href="{{route('employees.index')}}"
                                       class="btn btn-white me-3">{{__('back')}}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
