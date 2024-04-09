@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-12 mb-12">
            <h2 class="flex items-center gap-2 text-neutral-700">
                <x-ui.icon icon="rocket-outline" class="w-8 h-8"></x-ui.icon>
                <span class="text-2xl font-medium">پیشخوان</span>
            </h2>
        </div>

        <section class="grid grid-cols-12 lg:gap-12 mt-5 lg:mt-8">

            @include('front.dashboard._vertica_nav')

            <div class="col-span-12 lg:col-span-8">
                <div class="pb-2">
                    @include('flash')
                </div>

                <section class="grid grid-cols-12 gap-y-4 lg:gap-8">
                    <div class="col-span-12 lg:col-span-4">
                        <x-dashboard.colored_card class="bg-amber-200 text-amber-700" title="دوره های من"
                                                  icon="students-outline"
                                                  :amount="$courses_count"></x-dashboard.colored_card>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <x-dashboard.colored_card class="bg-sky-200 text-sky-700" title="امتیازهای من" icon="trophy"
                                                  :amount="auth()->user()->xp_points"></x-dashboard.colored_card>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <x-dashboard.colored_card class="bg-lime-200 text-lime-700" title="عضویت در لاراپلاس از"
                                                  icon="clock"
                                                  :amount="auth()->user()->created_at->toJalali('Y/m/d')"></x-dashboard.colored_card>
                    </div>
                </section>

                <section>

                    <div class="flex items-center justify-between mt-12">
                        <h3 class="text-lg lg:text-2xl">آخرین دوره های من</h3>
                        <a href="{{ route('dashboard.course.index') }}" class="text-sm text-blue-500 hover:border-b hover:border-dashed hover:opacity-70" >مشاهده همه</a>
                    </div>

                    <div class="mt-6 flex flex-col lg:flex-row gap-6">
                        @foreach($latest_courses as $course)
                            <x-front.course-item-row :course="$course"></x-front.course-item-row>
                        @endforeach
                    </div>

                </section>

            </div>
        </section>


    </div>
    </div>
@endsection
