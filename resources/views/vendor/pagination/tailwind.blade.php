@if ($paginator->hasPages())
    <nav role="navigation" aria-label="صفحه بندی" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 gap-2 sm:hidden">
            @if (! $paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="relative flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-emerald-600 border border-emerald-600 leading-5  hover:text-white hover:bg-emerald-600 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    &lsaquo; صفحه قبل

                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-emerald-600 border border-emerald-600 leading-5  hover:text-white hover:bg-emerald-600 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                     صفحه بعد &rsaquo;
                </a>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">

            <div>
                <span class="relative z-0 flex items-center gap-2 shadow-sm rounded-md">

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative flex items-center justify-center w-10 h-10 rounded-full font-medium border border-emerald-600 text-emerald-600 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative w-10 h-10 rounded-full border-emerald-600 bg-emerald-600 text-white flex items-center justify-center text-xl font-medium border cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="bg-white border border-emerald-600 rounded-full text-emerald-600 w-10 h-10 flex items-center justify-center text-xl leading-5  hover:text-white hover:bg-emerald-600 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('برو به صفحه :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    
                </span>
            </div>
        </div>
    </nav>
@endif
