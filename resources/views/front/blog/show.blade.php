@extends('front.layouts.main', [
    'page_title' => $post->seoTitle(),
    'page_description' => $post->seoDescription(),
    'page_keywords' => $post->seoKeywords(),
    'page_image' => $post->featuredImage(),
    'canonical_url' => $post->viewLink(),
])

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-6 grid grid-cols-12 lg:gap-x-4">
            <div class="col-span-12 lg:col-span-9">
                <x-front.card>
                    <div class="text-2xl md:text-3xl font-medium pt-3">
                        <h1 class="leading-relaxed">{{ $post->title }}</h1>
                    </div>

                    <div class="mt-8 flex items-center gap-6 text-gray-500 text-sm pb-6 mb-6 border-b border-gray-300">
                        <span class="flex gap-1 items-center">
                            <x-ui.icon class="!h-5 !w-5" icon="eye"></x-ui.icon>
                            <span>{{ number_format($post->views) }} بازدید</span>
                        </span>
                        <span class="flex gap-1 items-center">
                            <x-ui.icon class="!h-5 !w-5" icon="clock"></x-ui.icon>
                            <span>{{ $post->created_at->toJalali()->formatDifference() }}</span>
                        </span>

                        <span class="flex gap-1 items-center">
                            <x-ui.icon class="!h-5 !w-5" icon="comment"></x-ui.icon>
                            <span>{{ $comments_count }} دیدگاه</span>
                        </span>
                    </div>

                    <div class="description">
                        {!! $post->body !!}
                    </div>
                </x-front.card>

                @include('front.blog._comments')
            </div>
            <div class="col-span-12 lg:col-span-3">
                <x-front.tags :tags="$tags" type="post"></x-front>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('front/vendor/highlightjs/default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/blog.css') }}">
@endsection
@section('scripts')
    {{--    <script type="text/javascript" src="{{ asset('front/js/gist-embed.min.js') }}"></script> --}}

    <script src="{{ asset('front/vendor/highlightjs/highlight.min.js') }}"></script>

    <script>
        hljs.highlightAll();
    </script>
@endsection
