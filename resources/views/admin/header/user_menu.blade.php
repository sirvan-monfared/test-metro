<div class="me-3">
    <a href="#" class="btn btn-icon btn-custom btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <span class="svg-icon svg-icon-1 svg-icon-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
            </svg>
        </span>
    </a>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="{{ asset('admin/media/avatars/300-1.jpg') }}" />
                </div>
                <div class="d-flex flex-column">
                    <div class="fw-bolder d-flex align-items-center fs-5"> {{ auth()->user()->name   }}
                        <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">مدیر ارشد</span></div>
                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                </div>
            </div>
        </div>

        <div class="separator my-2"></div>

        <div class="menu-item px-5">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="bg-white border-0 menu-link px-5 px-5 fs-2">خروج</button>
            </form>

        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>

        <div class="menu-item px-5">
            <div class="menu-content px-5">
                <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                    <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="../../demo9/dist/index.html" />
                    <span class="pulse-ring ms-n1"></span>
                    <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                </label>
            </div>
        </div>
    </div>
</div>
