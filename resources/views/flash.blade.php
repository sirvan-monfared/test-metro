@if ($message = session()->get('success'))
    <div class="w-full text-white bg-green-500 py-3 text-lg text-center rounded-md">
        {{ $message }}
    </div>
@endif


@if ($message = session()->get('error'))
    <div class="w-full bg-rose-300 text-rose-800 py-3 text-lg text-center rounded-md">
        {{ $message }}
    </div>
@endif



@if ($message = session()->get('warning'))
    <div class="w-full text-neutral-800 bg-yellow-600 py-3 text-lg text-center rounded-md">
        {{ $message }}
    </div>
@endif


@if ($message = session()->get('info'))
    <div class="w-full text-white bg-blue-600 py-3 text-lg text-center rounded-md">
        {{ $message }}
    </div>
@endif

@if ($errors->any() && (! isset($show_list) || $show_list)))
    <div class="w-full bg-rose-300 p-3 rounded-md">
        <h6 class="text-rose-800 text-lg font-semibold">لطفا مشکلات ذکرشده را برطرف نمایید</h6>

        <ul class="space-y-1 mt-6">
            @foreach($errors->all() as $error)
                <li class="text-base text-rose-800 bullet-line">{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif


