<?php

namespace App\Notifications\Telegram;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class NewPaidOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
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
            ->content("یک پرداختی جدید به مبلغ * " . $this->order->price . " تومان * در سایت ثبت شد \n");

        foreach ($this->order->items() as $item) {
            $notification->line("- ". $item->model()->title ." \n");
        }

        $notification->button('مشاهده پرداخت', route('admin.order.show', $this->order->id));
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
