@extends('front.layouts.main', [
    'page_title' => $podcast->seoTitle(),
    'page_description' => $podcast->seoDescription(),
    'page_keywords' => $podcast->seoKeywords(),
    'canonical_url' => $podcast->viewLink(),
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
                        <h1 class="leading-relaxed">{{ $podcast->title }}</h1>
                    </div>

                    <div class="mt-8 flex items-center gap-6 text-gray-500 text-sm pb-6 mb-6 border-b border-gray-300">
                        <span class="flex gap-1 items-center">
                            <x-ui.icon class="!h-5 !w-5" icon="code"></x-ui.icon>
                            <span>اپیزود {{ $podcast->episode }}</span>
                        </span>
                        <span class="flex gap-1 items-center">
                            <x-ui.icon class="!h-5 !w-5" icon="clock"></x-ui.icon>
                            <span>{{ $podcast->duration }} دقیقه</span>
                        </span>
                        <span class="flex gap-1 items-center">
                            <x-ui.icon class="!h-5 !w-5" icon="comment"></x-ui.icon>
                            <span>{{ $comments_count }} دیدگاه</span>
                        </span>
                    </div>

                    <div class="description">
                        @if ($podcast->path)
                            <iframe src="{{ $podcast->path }}?v=8.22.11&autoplay=1&hide_list=1" frameborder="0"
                                width="100%" height="200"></iframe>
                            <div class="mt-5">&nbsp;</div>
                        @endif

                        {!! $podcast->description !!}
                    </div>
                </x-front.card>

                @include('front.podcast._comments')

            </div>

            <div class="col-span-12 lg:col-span-3">
                <x-front.tags :tags="$tags" type="podcast"></x-front>
            </div>
        </div>
    </div>
@endsection
