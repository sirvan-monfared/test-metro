@extends('front.layouts.main', [
    'page_title' => $course->seoTitle(),
    'page_description' => $course->seoDescription(),
    'page_keywords' => $course->seoKeywords(),
    'page_image' => $course->featuredImage(),
    'canonical_url' => $course->viewLink(),
    'page_schema' => $page_schema,
])

@section('content')
    <section class="container lg:hidden">
        <div class="p-5">
            <x-front.breadcrumbs class="lg:text-violet-200" :items="$breadCrumbs" v-pre>
            </x-front.breadcrumbs>
        </div>
    </section>


    <section class="container lg:max-w-screen-xl mx-auto">

        <!-- image and video  -->
        @include('front.course._featured_video')

        <!-- description -->
        <div class="px-5 mt-5 flex flex-col gap-5">
            <h1 class="font-bold text-2xl">{{ $course->alter_name ?: $course->title }}</h1>

            <div class="flex items-center gap-5">
                <span class="text-amber-500 font-medium">{{ $average_ratings }}</span>
                <div class="flex items-center gap-0.5">
                    <rate-with-stars :show="true" :stars="{{ $average_ratings }}" size="20"></rate-with-stars>
                </div>
                <a class="text-blue-500 border-dashed hover:text-amber-500 hover:border-current cursor-pointer">
                    ({{ $comments_count }} دیدگاه)
                </a>
            </div>

            <div class="text-base text-gray-700 leading-relaxed">
                {!! $course->short_description !!}
            </div>
        </div>

        <!-- meta information and cart box -->
        <div class="px-5 mt-5">
            @include('front.course._details_card_mobile')
        </div>
    </section>


    <!-- what you'll learn -->
    <section class="container mx-auto lg:max-w-screen-xl mt-9">
        <div class="px-5">
            @include('front.course._what_you_learn')
        </div>
    </section>

    <section class="container mx-auto lg:max-w-screen-xl mt-9 px-5">
        @include('front.course._project_link')
    </section>


    <!-- course content -->
    <main class="container mx-auto lg:max-w-screen-xl mt-9">

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
            <section class="mt-8">
                @include('front.course._faqs')
            </section>
        </div>

    </main>



    <!-- reviews -->
    <aside class="container mx-auto lg:max-w-screen-xl mt-12">
        @include('front.course._reviews_mobile')
    </aside>


    <!-- mobile add to cart footer button -->
    <section class="md:hidden sticky bottom-[69px] z-10 bg-white border border-gray-300 shadow-lg">
        <div class="py-3 px-5 flex items-center justify-between">
            @if (
                !auth()->user()
                    ?->alreadyEnrolledIn($course))
                <span class="w-1/4 text-lg font-bold flex items-center justify-center flex-wrap gap-1 shrink-0">
                    {!! $course->showPrice(bigFontSize: false) !!}
                </span>
            @endif
            <x-front.add-to-cart-button :course="$course" :redirect="true" :showPrice="false"
                class="w-full mt-3 py-3 justify-center !text-lg !bg-gray-700"></x-front.add-to-cart-button>
        </div>
    </section>
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
