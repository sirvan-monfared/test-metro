@if(! auth()->user()?->alreadyEnrolledIn($course))

    @if (isset($redirect) && $redirect)
        <add-to-cart-button class="{{ $attributes->merge(['class' => ''])->get('class') }}" :id="{{ $course->id }}" already-in-cart="{{ $course->isInCart() }}" :instant-redirect="true"></add-to-cart-button>
    @else
        <add-to-cart-button class="{{ $attributes->merge(['class' => ''])->get('class') }}" :id="{{ $course->id }}" already-in-cart="{{ $course->isInCart() }}" :instant-redirect="false"></add-to-cart-button>
    @endif

    @if(! isset($showPrice) || $showPrice)
        <div class="prce142">{!! $course->showPrice() !!}</div>
    @endif
@else
    <a href="{{ route('dashboard') }}" type="button" class="w-full border border-rose-500 py-2 px-4 text-center mt-6 text-rose-500 text-sm font-medium rounded-md hover:bg-rose-500 hover:text-white transition-all duration-300">شما قبلا در این دوره ثبت نام کرده اید. ادامه یادگیری؟</a>
@endif



