<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::Search-->
            <!--begin::Languages-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm"
                             src="{{asset('admin/assets/media/svg/flags/226-united-states.svg')}}" alt=""/>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div
                    class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">
                        <!--begin::Item-->
                        <li class="navi-item">
                            <a href="#" class="navi-link">
													<span class="symbol symbol-20 mr-3">
														<img
                                                            src="{{asset('admin/assets/media/svg/flags/226-united-states.svg')}}"
                                                            alt=""/>
													</span>
                                <span class="navi-text">English</span>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="navi-item active">
                            <a href="#" class="navi-link">
													<span class="symbol symbol-20 mr-3">
														<img
                                                            src="{{asset('admin/assets/media/svg/flags/128-spain.svg')}}"
                                                            alt=""/>
													</span>
                                <span class="navi-text">Spanish</span>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="navi-item">
                            <a href="#" class="navi-link">
													<span class="symbol symbol-20 mr-3">
														<img
                                                            src="{{asset('admin/assets/media/svg/flags/162-germany.svg')}}"
                                                            alt=""/>
													</span>
                                <span class="navi-text">German</span>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="navi-item">
                            <a href="#" class="navi-link">
													<span class="symbol symbol-20 mr-3">
														<img
                                                            src="{{asset('admin/assets/media/svg/flags/063-japan.svg')}}"
                                                            alt=""/>
													</span>
                                <span class="navi-text">Japanese</span>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="navi-item">
                            <a href="#" class="navi-link">
													<span class="symbol symbol-20 mr-3">
														<img
                                                            src="{{asset('admin/assets/media/svg/flags/195-france.svg')}}"
                                                            alt=""/>
													</span>
                                <span class="navi-text">French</span>
                            </a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Languages-->
            <!--begin::User-->
            <div class="topbar-item">
                <div
                    class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                    id="kt_quick_user_toggle">
                                <span
                                    class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span
                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
										</span>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->



<style>
    .rating {
        display: inline-block;
        justify-content: center;
    }

    .rating input {
        display: none;
    }

    .rating label {
        color: #ddd;
        float: right;
        font-size: 40px;
        margin-bottom: 0;
        cursor: pointer;
    }

    .rating label:before {
        content: '\2605';
    }

    .rating input:checked ~ label,
    .rating input:checked ~ label ~ label {
        color: #ffca08;
    }
</style>
