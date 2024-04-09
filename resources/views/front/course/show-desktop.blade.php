@extends('front.layouts.main', [
    'page_title' => $course->seoTitle(),
    'page_description' => $course->seoDescription(),
    'page_keywords' => $course->seoKeywords(),
    'page_image' => $course->featuredImage(),
    'canonical_url' => $course->viewLink(),
    'page_schema' => $page_schema,
])

@section('content')
    <div>
        <div data-sticky-container>
            <section class="bg-gray-800 text-white ">
                <div class="container mx-auto lg:max-w-screen-xl">
                    <div class="px-5 py-6">
                        <div class="grid grid-cols-12 gap-10 items-start relative">
                            <div class="col-span-8">
                                <div class="text-white p-5">

                                    <x-front.breadcrumbs class="lg:text-violet-200" :items="$breadCrumbs" v-pre>
                                    </x-front.breadcrumbs>


                                    <!-- main informations -->
                                    <div class="mt-5 flex flex-col gap-5">
                                        <h1 class="font-bold text-3xl">{{ $course->alter_name ?: $course->title }}</h1>
                                        <div class="flex items-center gap-5 ">
                                            <span class="text-amber-500">{{ $average_ratings }}</span>
                                            <div class="flex items-center gap-0.5">
                                                <rate-with-stars :show="true" :stars="{{ $average_ratings }}"
                                                    size="17"></rate-with-stars>
                                            </div>
                                            <a
                                                class="lg:text-violet-200 border-dashed hover:text-amber-500 hover:border-current cursor-pointer">
                                                ({{ $comments_count }} دیدگاه)
                                            </a>
                                        </div>
                                        <div class="text-base text-gray-700 lg:text-white lg:text-xl lg:leading-relaxed">
                                            {!! $course->short_description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- sidebar -->
                            <div class="col-span-4 relative" data-sticky data-margin-top="80">
                                @include('front.course._desktop_sidebar')
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section class="container mx-auto lg:max-w-screen-xl">
                <div class="px-5 py-6">
                    <div class="grid grid-cols-12 gap-10 items-start">
                        <!-- main part -->
                        <div class="col-span-8">

                            <!-- what you'll learn -->
                            @include('front.course._what_you_learn')

                            <div class="mt-8">
                                @include('front.course._project_link')
                            </div>

                            <!-- course content -->
                            <main class="mt-7 lg:mt-12">
                                <div class="px-5 lg:px-0">

                                    {{-- content list --}}
                                    @include('front.course._content_list', [
                                        'showRealLinks' => false,
                                    ])

                                    <!-- course description -->
                                    <section class="mt-8 bg-white rounded-md shadow-md shadow-gray-300 p-5">
                                        @include('front.course._description')
                                    </section>


                                    <!-- FAQ -->
                                    @if ($course->faqs?->count() > 0)
                                        <section class="mt-8">
                                            @include('front.course._faqs')
                                        </section>
                                    @endif

                                </div>
                            </main>

                            <!-- reviews -->
                            <aside class="container mx-auto lg:max-w-screen-xl mt-12">
                                @include('front.course._reviews')
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('front/vendor/sticky/sticky.min.js') }}"></script>

    <script>
        var sticky = new Sticky('[data-sticky]');
    </script>

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



    {{-- <script src="/node_modules/swiper/swiper-bundle.min.js"></script> --}}

    {{-- <script src="{{ asset('front/js/custom.js') }}" defer></script>
    <script>
        window.addEventListener('load', function() {
            startAccordion('course-content-accordion');
            startAccordion('faqs-accordion');
            startStickyNav();
        }, false);
    </script> --}}
@endsection
