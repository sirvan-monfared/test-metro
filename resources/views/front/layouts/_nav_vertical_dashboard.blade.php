<x-front.vertical-nav>
    <ul class="mt-14 flex flex-col gap-8 text-neutral-800 font-medium">
        <li @class(['text-rose-600' => request()->routeIs('dashboard')])>
            <a class="flex items-center gap-2" href="{{ route('dashboard') }}">
                <x-ui.icon icon="rocket-outline"></x-ui.icon>
                <span>پیشخوان </span>
            </a>
        </li>

        <li @class(['text-rose-600' => request()->routeIs('dashboard.course.index')])>
            <a class="flex items-center gap-2" href="{{ route('dashboard.course.index') }}">
                <x-ui.icon icon="students-outline"></x-ui.icon>
                <span>دوره های من </span>
            </a>
        </li>

        <li @class(['text-rose-600' => request()->routeIs('dashboard.order.history')])>
            <a class="flex items-center gap-2" href="{{ route('dashboard.order.history') }}">
                <x-ui.icon icon="orders"></x-ui.icon>
                <span>سفارش های من</span>
            </a>
        </li>
        <li @class(['text-rose-600' => request()->routeIs('dashboard.profile.edit')])>
            <a class="flex items-center gap-2" href="{{ route('dashboard.profile.edit') }}">
                <x-ui.icon icon="person"></x-ui.icon>
                <span>ویرایش مشخصات کاربری</span>
            </a>
        </li>
        <li @class(['text-rose-600' => request()->routeIs('dashboard.apikey.index')])>
            <a class="flex items-center gap-2" href="{{ route('dashboard.apikey.index') }}">
                <x-ui.icon icon="shield"></x-ui.icon>
                <span>کد هویت سنجی من</span>
            </a>
        </li>
    </ul>
</x-front.vertical-nav>


