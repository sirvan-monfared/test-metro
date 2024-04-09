@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">

        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-12 mb-12">
            <h2 class="flex items-center gap-2 text-neutral-700">
                <x-ui.icon icon="students-outline" class="w-8 h-8"></x-ui.icon>
                <span class="text-2xl font-medium">دوره های من</span>
            </h2>
        </div>

        <section class="grid grid-cols-12 lg:gap-12 mt-5 lg:mt-8">

            @include('front.dashboard._vertica_nav')

            <div class="col-span-12 lg:col-span-8">

                @include('flash')

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-12 md:gap-x-5">
                    @forelse($courses as $course)
                        <x-front.course-item :course="$course" :alreadyBought="true"></x-front.course-item>
                    @empty
                        <div class="mt-8 col-span-full lg:mt-12 w-full">
                            <x-front.no-item-found icon="cry">
                                هنوز هیچ دوره ای از ما تهیه نکردی!
                            </x-front.no-item-found>

                        </div>
                    @endforelse
                </div>
            </div>
        </section>


    </div>
    </div>
@endsection
