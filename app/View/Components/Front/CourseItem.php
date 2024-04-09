<?php

namespace App\View\Components\Front;

use App\Models\Course;
use Illuminate\View\Component;
use function view;

class CourseItem extends Component
{
    public Course $course;
    public bool $alreadyBought;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Course $course, $alreadyBought = false)
    {
        $this->course = $course;
        $this->alreadyBought = $alreadyBought;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.course-item');
    }
}
