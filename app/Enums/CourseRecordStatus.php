<?php
namespace App\Enums;

enum CourseRecordStatus :int
{
    case RECORDING = 1;
    case FINISHED = 2;

    public function title()
    {
        return match ($this) {
            self::RECORDING => 'در حال ضبط',
            self::FINISHED => 'تکمیل ضبط'
        };
    }

    public function isStillRecording()
    {
        return $this === self::RECORDING;
    }

    public function textColor()
    {
        return match ($this) {
            self::RECORDING => 'text-yellow-900',
            self::FINISHED => 'text-emerald-800'
        };
    }

    public function bgColor()
    {
        return match ($this) {
            self::RECORDING => 'bg-yellow-200',
            self::FINISHED => 'bg-emerald-100'
        };
    }
}