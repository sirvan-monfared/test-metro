<nav class="hidden lg:block lg:col-span-4">
    <ul class="bg-white shadow-sm border border-gray-100">
        <li>
            <x-dashboard.nav-link route_name="dashboard.point.index">
                <div class="flex justify-between items-center w-full">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6">
                            <x-ui.icon icon="trophy" class="stroke-sky-500"></x-ui.icon>
                        </div>
                        <span class="font-medium">امتیازها: </span>
                    </div>
                    <span>{{ number_format(auth()->user()->xp_points) }} امتیاز </span>
                </div>
            </x-dashboard.nav-link>
        </li>

        <div class="w-full border-b border-dashed border-gray-300"></div>
        <li>
            <x-dashboard.nav-link route_name="dashboard" icon="rocket-outline" title="پیشخوان"></x-dashboard.nav-link>
        </li>
        <li>
            <x-dashboard.nav-link route_name="dashboard.course.index" icon="students-outline" title=" دوره های من"></x-dashboard.nav-link>
        </li>
        <li>
            <x-dashboard.nav-link route_name="dashboard.order.history" icon="orders" title="سفارش های من"></x-dashboard.nav-link>
        </li>
        <li>
            <x-dashboard.nav-link route_name="dashboard.profile.edit" icon="person" title="ویرایش مشخصات کاربری"></x-dashboard.nav-link>
        </li>
        <li>
            <x-dashboard.nav-link route_name="dashboard.apikey.index" icon="shield" title="کد هویت سنجی من"></x-dashboard.nav-link>
        </li>
        <li>
            <form method="POST" action="{{route('logout')}}" class="item channel_item">
                @csrf

                <div class="flex items-center gap-3 px-5 py-4 text-gray-800 hover:bg-sky-100 hover:text-sky-400 text-base">
                    <div class="w-6 h-6">
                        <x-ui.icon icon="sign-out" class="stroke-sky-500"></x-ui.icon>
                    </div>
                    <button type="submit" class="item channel_item logout-btn font-medium w-full text-start">خروج</button>
                </div>
            </form>
        </li>
    </ul>
</nav>
