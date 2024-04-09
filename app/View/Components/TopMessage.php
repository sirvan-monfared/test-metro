<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopMessage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.top-message', [
            'show' => config('settings.top_message.show'),
            'text' => config('settings.top_message.text'),
            'link' => config('settings.top_message.link')
        ]);
    }
}
