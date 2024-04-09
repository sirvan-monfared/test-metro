<?php

namespace App\Notifications;

use App\Kodesign\SMS\CourseEnrolledSms;
use App\Mail\CourseEnrolledMail;
use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SuccessfulCourseEnrollment extends Notification implements ShouldQueue
{
    use Queueable;

    private Course $course;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        $via = ['database'];
        if ($notifiable->hasVerifiedEmail()) {
            $via[] = 'mail';
        }
        if ($notifiable->hasVerifiedEmail() && config('sms.after_successful_enrollment')) {
            $via[] = SmsChannel::class;
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(mixed $notifiable): CourseEnrolledMail
    {
        return (new CourseEnrolledMail($this->course))
                    ->to($notifiable->email);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSms(mixed $notifiable): CourseEnrolledSms
    {
        return (new CourseEnrolledSms($this->course))
                    ->to($notifiable->phone);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
