<div class="{{ $course->record_status->bgColor() }} {{ $course->record_status->textColor() }} rounded-full py-1 px-2 flex items-center gap-1">
    <x-ui.icon icon="microphone" class="!w-4 !h-4"></x-ui.icon>
    {{ $slot }}
</div>