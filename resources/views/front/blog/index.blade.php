@extends('front.layouts.main', [
    'page_title' => 'وبلاگ لاراپلاس',
    'add_title_suffix' => false,
])

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-5 lg:mt-8">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-y-12 md:gap-x-5">
                @forelse($posts as $post)
                    <x-front.blog-item :post="$post" :loop="$loop"></x-front.blog-item>
                @empty
                    <x-front.no-item-found class="col-span-full"></x-front.no-item-found>
                @endforelse
            </div>

            @if(count($posts) > 0)
                <div class="flex items-center justify-center my-10">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
