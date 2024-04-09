@extends('front.layouts.main', [
    'page_title' => 'پادکست های برنامه نویسی',
])


@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-5 lg:mt-8">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-y-12 md:gap-x-5">
                @forelse($podcasts as $podcast)
                    <x-front.podcast-item :loop="$loop" :podcast="$podcast"></x-front.podcast-item>
                @empty
                    <x-front.no-item-found class="col-span-full"></x-front.no-item-found>
                @endforelse
            </div>

            @if(count($podcasts) > 0)
                <div class="flex items-center justify-center my-10">
                    {{ $podcasts->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
