@extends('front.layouts.main', [
    'page_title' => $tag
])

@section('content')

<div class="rtl">
    <div class="container-fluid">

        <x-front.breadcrumbs :items="$breadCrumbs"></x-front.breadcrumbs>

        <div class="row">
            <div class="col-lg-11 col-md-12 mb-30 m-auto">
                <div class="row">
                    @forelse($items as $item)
                        @if(class_basename($item) === 'Post')
                            <x-front.blog-item :post="$item"></x-front.blog-item>
                        @elseif(class_basename($item) === 'Podcast')
                            <x-front.podcast-item :podcast="$item"></x-front.podcast-item>
                        @endif
                    @empty
                        <x-front.no-item-found></x-front.no-item-found>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
