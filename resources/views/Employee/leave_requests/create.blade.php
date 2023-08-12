@extends('Dashboard.master')

@section('title')
    Add Leave Request
@endsection
@section('Page-title')
    Add Leave Request
@endsection
@section('content')
    <div class="col-12">
        <div class="card mb-6">
            <div class="card-body">
                @can('leaves-request-create')
                    <form method="POST" action="{{ route("leaves_request.store") }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{\App\Models\Employee::where('email',auth()->user()->email)->pluck('id')}}">
                        <div class="form-group row pt-4">
                            <div class="col-lg-6">
                                <label for="duration">Duration<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon-clock-2"></x-input-group>
                                    <x-input name='duration' type='text' value='{{ $leave_request->duration }}' placeholder="Enter Duration"></x-input>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="duration_unit">Duration Unit<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon-clock-1"></x-input-group>
                                    <select class="form-control {{ $errors->has('duration_unit') ? 'is-invalid' : '' }}"
                                            name="duration_unit" id="duration_unit">
                                        <option value="" disabled selected>Select Type Leave</option>
                                        <option value="hours" {{ old('duration_unit') === 'hours' ? 'selected' : '' }}>
                                            Hours
                                        </option>
                                        <option value="hours" {{ old('duration_unit') === 'days' ? 'selected' : '' }}>
                                            Days
                                        </option>
                                        <option value="hours" {{ old('duration_unit') === 'weeks' ? 'selected' : '' }}>
                                            Weeks
                                        </option><option value="hours" {{ old('duration_unit') === 'months' ? 'selected' : '' }}>
                                            Months
                                        </option>
                                    </select>
                                    @if($errors->has('duration_unit'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('duration_unit') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row pt-4">
                            <div class="col-lg-6">
                                <label for="start_date">Start Date</label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon2-calendar"></x-input-group>
                                    <x-input name='start_date' type='date' value='{{ $leave_request->start_date }}' placeholder="Enter Start Date"></x-input>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="end_date">End Date<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon2-calendar"></x-input-group>
                                    <x-input name='end_date' type='date' value='{{ $leave_request->end_date }}' placeholder="Enter End Date"></x-input>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row pt-4">
                            <div class="col-lg-6">
                                <label for="leave_reason">Leave Reason<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon-edit"></x-input-group>
                                    <x-input name='leave_reason' type='text' value='{{ $leave_request->leave_reason }}' placeholder="Enter Reason" ></x-input>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="leave_type">Type Leave</label>
                                <div class="input-group">
                                    <x-input-group icon="flaticon2-file"></x-input-group>
                                    <select class="form-control {{ $errors->has('leave_type') ? 'is-invalid' : '' }}"
                                            name="leave_type" id="leave_type">
                                        <option value="" disabled selected>Select Type Leave</option>
                                        @foreach($leave_types as $leave_type)
                                        <option value="{{$leave_type->name}}">{{$leave_type->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('leave_type'))
                                        <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('leave_type') }}
                                    </span>
                                    @endif
                                </div>

                            </div>
                        </div>


                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    @can('leaves-request-create')
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Save</span>
                                        </button>
                                    @endcan
                                    <input type="reset" value="Reset" class="btn btn-white me-3">
                                    <a type="button" href="{{route('leaves_request.index')}}"
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
