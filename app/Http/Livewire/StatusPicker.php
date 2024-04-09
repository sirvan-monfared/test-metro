<?php

namespace App\Http\Livewire;

use App\Enums\Status;
use Livewire\Component;

class StatusPicker extends Component
{

    public $status;
    public $statusEnumClass;

    public $title;

    public function mount($status, $statusEnumClass = null, $title = 'وضعیت انتشار') {
        $this->status = $status?->value ?: 1;
        $this->statusEnumClass = $statusEnumClass ?: Status::class;
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.status-picker');
    }
}
