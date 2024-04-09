<!DOCTYPE html>
<html lang="fa" class="scroll-smooth">

<head>
    @php
        $seo_title = $page_title ?? 'آموزش برنامه نویسی وب پروژه محور ';
        $seo_description = $page_description ?? 'آموزش تخصصی برنامه نویسی همراه با پروژه های واقعی به صورت مربی محور و پشتیبانی دائمی با آپدیت های رایگان ';
        $seo_keywords = $page_keywords ?? null;
    @endphp

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $seo_title }} {{ !isset($add_title_suffix) || $add_title_suffix ? '| لاراپلاس' : false }}</title>


    <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width" />
    <meta name="description" content="{{ $seo_description }} | لاراپلاس">
    @if ($seo_keywords)
        <meta name="keywords" content="{{ $seo_keywords }}">
    @endif
    <meta name="author" content="Sirvan Monfared | سیروان منفرد">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:title" content="{{ $seo_title }} | لاراپلاس" />
    <meta property="og:description" content="{{ $seo_description }} | لاراپلاس" />
    <meta property="og:type" content="{{ $page_type ?? 'article' }}" />
    <meta property="og:url" content="{{ $canonical_url ?? url()->current() }}" />
    <meta property="og:locale" content="fa_IR" />
    <meta property="og:site_name" content="لاراپلاس مرجع آموزش های پروژه محور برنامه نویسی" />
    <meta property="og:brand" content="لاراپلاس" />
    @if (isset($page_image))
        <meta property="og:image" content="{{ $page_image }}" />
    @endif

    @if (isset($canonical_url))
        <link rel="canonical" href="{{ $canonical_url }}" />
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('front/css/new-theme/app-new.css') }}">

    @yield('styles')

    @if (isset($page_schema))
        {!! $page_schema !!}
    @endif

    {{-- @production
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-0G1K1L00PY"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-0G1K1L00PY');
        </script>
    @endproduction --}}

</head>

<body dir="rtl" class="min-h-screen bg-gray-50 {{ $body_class ?? null }}" x-data="{ openMenu: false }"
    x-bind:class="openMenu ? 'overflow-hidden' : 'overflow-y-visible overflow-x-hidden'">

    @if (isset($no_content) && $no_content)
        @yield('content')
    @endif

    @if (!isset($no_content) || !$no_content)
        <div id="app">

            @include('front.layouts._nav_main')

            @yield('content')


            @unless (isset($minimal) && $minimal)
                {{-- footer mobile --}}
                @include('front.layouts._footer_mobile')

                {{-- footer desktop --}}
                @include('front.layouts._footer_desktop')

            @endunless
        </div>

        @if (isDashboardPanel())
            @include('front.layouts._nav_vertical_dashboard')
        @else
            @include('front.layouts._nav_vertical')
        @endif
    @endif

    <script src="{{ mix('application/vue-front.js') }}" defer></script>

    @yield('scripts')
</body>

</html>
