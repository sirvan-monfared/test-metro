<?php

namespace App\Notifications\Telegram;

use App\Models\Exercise;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class NewExerciseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Exercise $exercise)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toTelegram(object $notifiable): TelegramMessage
    {
        $notification = TelegramMessage::create()
            ->to(config('services.telegram-bot-api.chat_id'))
            ->content("یک تمرین جدید در دوره {$this->exercise->course->title} توسط کاربر {$this->exercise->student->publicName()} در سایت ثبت شد \n");


        $notification->button('مشاهده تمرین', route('admin.exercise.edit', $this->exercise->id));
        return $notification;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
