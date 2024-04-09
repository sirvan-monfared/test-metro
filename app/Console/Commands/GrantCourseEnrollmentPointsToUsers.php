<?php

namespace App\Console\Commands;

use App\Events\CourseEnrolled;
use App\Models\Enrollment;
use App\Services\UserPointsService;
use Illuminate\Console\Command;

class GrantCourseEnrollmentPointsToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'point:course-enrollment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command grant points to all users who already bought a course';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $enrollments = Enrollment::with(['course', 'student', 'order'])->get()->filter(fn($enrollment) => ! $enrollment->course->isFree());

        $this->withProgressBar($enrollments, function(Enrollment $enrollment) {
            event(new CourseEnrolled($enrollment->course, $enrollment->student));
        });

        $this->newLine();
        $this->info("Successfully granted Points to all user for course enrollment");
    }
}
