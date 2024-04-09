@component('mail::message')
    تبریک!
    <br> <br>
    ممنونم که به ما اعتماد کردی و توی دوره
    <strong> {{ $course->title }} </strong>
    ثبت نام کردی
    <br> <br>
    مطمئن هستم که از کیفیت آموزش و پشتیبانی دوره های لاراپلاس شگفت زده میشی!
    <br> <br>
    @if(! $course->isFree())
         برای مشاهده محتوای این دوره روی لینک زیر کلیک کن و طبق دستورالعملی که در ابتدای این لینک قرار داده شده عمل کن
         <br> <br>
    @endif
    @component('mail::button', ['url' => "https://laraplus.ir/dashboard/course/". $course->slug])
        مشاهده محتوای دوره
    @endcomponent


    <br> <br>
    باتشکر<br>
    لاراپلاس <br>
    www.laraplus.ir
@endcomponent
