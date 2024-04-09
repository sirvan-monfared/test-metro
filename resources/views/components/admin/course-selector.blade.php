@props(['selected', 'required'])

<div>
    <div class="mw-150px">
        <select name="course_id" data-placeholder="نام دوره" {{ $attributes->merge(['class' => 'form-select form-select-solid']) }}>
            @if(! isset($required) || ! $required)
                <option value="" >همه</option>
            @endif

            @foreach($courses as $course)
                <option value="{{ $course->id }}" @selected($course->id == $selected)>{{ $course->title }}</option>
            @endforeach
        </select>
    </div>
</div>
