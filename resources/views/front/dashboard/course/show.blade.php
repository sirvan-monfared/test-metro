@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <h2 class="text-lg md:text-2xl font-medium mt-5 lg:mt-8 mb-10 ">{{ $course->title }}</h2>

        <div class="mt-5 lg:mt-8">
            @if (!$course->isFree())
                <div class="mb-5 w-full text-white bg-emerald-100 p-3 text-lg text-center rounded-md">
                    <x-ui.icon icon="info" class="!w-16 !h-16 stroke-emerald-800 mx-auto"></x-ui.icon>
                    <p class="text-emerald-800 font-semibold text-2xl mt-4 leading-relaxed">جهت دسترسی به محتوای این دوره
                        شماره موبایل، نام و نام خانوادگی و سیستم عاملی که با آن به مشاهده محتوای دوره میپردازید
                        را از طریق لینک زیر (تلگرام) ارسال نمایید
                        یا از طریق تلگرام به شماره 09114899693 ارسال نمایید
                    </p>
                    <a class="mt-5 inline-block bg-emerald-800 text-white py-1 px-2 rounded-md shadow-md hover:bg-emerald-900" href="https://t.me/laraplus_ir">کلیک کنید</a>
                </div>
            @endif


            <div class="grid grid-cols-12 items-start gap-4 lg:gap-12 mt-5 lg:mt-8">
                <div class="col-span-12 lg:col-span-7">
                    @include('front.course._content_list', ['showRealLinks' => true])
                </div>

                <div class="col-span-12 lg:col-span-5 mt-4 py-4 lg:py-0 lg:mt-0 border-t border-dashed border-gray-300 lg:border-0">
                    @include('front.dashboard.course._course_exercises')

                </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script>
    function accordion(section_ids) {
        const items = [];

        for (item of section_ids) {
            items[item] = false;
        }

        // open first item

        return {
            items: items,
            allOpened: false,
            clicked: function(section_id) {
                this.items[section_id] = !this.items[section_id];
            },
            openAll: function() {
                for (item of section_ids) {
                    this.items[item] = this.allOpened ? false : true;
                }

                this.allOpened = !this.allOpened;
            }
        }
    }
</script>
@endsection
