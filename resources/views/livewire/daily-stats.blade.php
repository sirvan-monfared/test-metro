<div class="me-3">
    <a href="#" class="btn btn-icon btn-custom btn-active-color-primary position-relative" data-kt-menu-trigger="click"
       data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg') }}-->
        <span class="svg-icon svg-icon-1 svg-icon-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none">
                <path opacity="0.3"
                      d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z"
                      fill="black"/>
                <path
                    d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z"
                    fill="black"/>
            </svg>
        </span>
    </a>

    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-md-300px" data-kt-menu="true">
            <div class="fw-bolder d-flex align-items-center justify-content-center fs-5 px-3 py-3">
                آمارهای امروز
            </div>
            <span class="text-muted fw-bold d-block fs-7 text-center">{{ now()->toJalali('l Y/m/d') }}</span>
            <div class="separator"></div>

        <!--begin::Menu item-->
        <div class="menu-item px-3">
                
            <div class="card-body pt-5">

                <div class="d-flex align-items-sm-center mb-7">
                    <div class="symbol symbol-50px me-5">
                        <span class="svg-icon svg-icon-3x mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M11.7752551,13.2928932 C12.3275399,13.2928932 12.7752551,12.845178 12.7752551,12.2928932 C12.7752551,11.7406085 12.3275399,11.2928932 11.7752551,11.2928932 C11.2229704,11.2928932 10.7752551,11.7406085 10.7752551,12.2928932 C10.7752551,12.845178 11.2229704,13.2928932 11.7752551,13.2928932 Z M11.2235429,9.10222252 C12.2904751,8.8163389 12.9236401,7.71966498 12.6377564,6.65273278 C12.3518728,5.58580057 11.2551989,4.95263559 10.1882667,5.23851922 C9.12133448,5.52440284 8.4881695,6.62107675 8.77405312,7.68800896 C9.05993675,8.75494117 10.1566107,9.38810614 11.2235429,9.10222252 Z M13.8117333,18.7614808 C14.8786655,18.4755972 15.5118305,17.3789232 15.2259469,16.311991 C14.9400633,15.2450588 13.8433893,14.6118939 12.7764571,14.8977775 C11.7095249,15.1836611 11.0763599,16.280335 11.3622436,17.3472672 C11.6481272,18.4141994 12.7448011,19.0473644 13.8117333,18.7614808 Z M7.68800896,15.2259469 C8.75494117,14.9400633 9.38810614,13.8433893 9.10222252,12.7764571 C8.8163389,11.7095249 7.71966498,11.0763599 6.65273278,11.3622436 C5.58580057,11.6481272 4.95263559,12.7448011 5.23851922,13.8117333 C5.52440284,14.8786655 6.62107675,15.5118305 7.68800896,15.2259469 Z M17.3472672,12.6377564 C18.4141994,12.3518728 19.0473644,11.2551989 18.7614808,10.1882667 C18.4755972,9.12133448 17.3789232,8.4881695 16.311991,8.77405312 C15.2450588,9.05993675 14.6118939,10.1566107 14.8977775,11.2235429 C15.1836611,12.2904751 16.280335,12.9236401 17.3472672,12.6377564 Z" fill="#000000" opacity="0.3"></path><path d="M17.6573343,19 L21,19 C21.5522847,19 22,19.4477153 22,20 C22,20.5522847 21.5522847,21 21,21 L12,21 C14.1432966,21 16.1116082,20.2507999 17.6573343,19 Z" fill="#000000"></path></g></svg>
                        </span>
                    </div>

                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="{{ route('admin.enrollment.index', ['from_date' => now()->toJalali('Y/m/d'), 'to_date' => now()->toJalali('Y/m/d')]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder">ثبت نام در دوره </a>
                            <span class="text-muted fw-bold d-block fs-7"></span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $enrollments }}</span>
                    </div>
                </div>

                 <div class="d-flex align-items-sm-center mb-7">

                    <div class="symbol symbol-50px me-5">
                        <span class="svg-icon svg-icon-3x mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" opacity="0.3" x="11.5" y="2" width="2" height="4" rx="1"/>
                                    <rect fill="#000000" opacity="0.3" x="11.5" y="16" width="2" height="5" rx="1"/>
                                    <path d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                    </div>

                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">واریزی ها </a>
                            <span class="text-muted fw-bold d-block fs-7"></span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{!! price_format($orders) !!}</span>
                    </div>
                </div>

                <div class="d-flex align-items-sm-center mb-7">

                    <div class="symbol symbol-50px me-5">
                        <span class="svg-icon svg-icon-3x mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path><path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path></g></svg>
                        </span>
                    </div>

                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="{{ route('admin.user.index', ['from_date' => now()->toJalali('Y/m/d'), 'to_date' => now()->toJalali('Y/m/d')]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder"> ثبت نام کاربر </a>
                            <span class="text-muted fw-bold d-block fs-7"></span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $users }}</span>
                    </div>
                </div>

                <div class="d-flex align-items-sm-center mb-7">

                    <div class="symbol symbol-50px me-5">
                        <span class="svg-icon svg-icon-3x mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M14.4862 18L12.7975 21.0566C12.5304 21.54 11.922 21.7153 11.4386 21.4483C11.2977 21.3704 11.1777 21.2597 11.0887 21.1255L9.01653 18H5C3.34315 18 2 16.6569 2 15V6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V15C22 16.6569 20.6569 18 19 18H14.4862Z" fill="black"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M6 7H15C15.5523 7 16 7.44772 16 8C16 8.55228 15.5523 9 15 9H6C5.44772 9 5 8.55228 5 8C5 7.44772 5.44772 7 6 7ZM6 11H11C11.5523 11 12 11.4477 12 12C12 12.5523 11.5523 13 11 13H6C5.44772 13 5 12.5523 5 12C5 11.4477 5.44772 11 6 11Z" fill="black"></path></g></svg>
                        </span>
                    </div>

                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="{{ route('admin.comment.index') }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder">  دیدگاه ها  </a>
                            <span class="text-muted fw-bold d-block fs-7"></span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $comments }}</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
