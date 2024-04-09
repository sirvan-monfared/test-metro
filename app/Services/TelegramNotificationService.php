<?php

namespace App\Services;

use App\Models\Exercise;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Telegram\DailyReportNotification;
use App\Notifications\Telegram\FailedPaymentNotification;
use App\Notifications\Telegram\NewCommentNotification;
use App\Notifications\Telegram\NewExerciseNotification;
use App\Notifications\Telegram\NewOrderNotification;
use App\Notifications\Telegram\NewPaidOrderNotification;
use App\Notifications\Telegram\UserRegistrationNotification;

class TelegramNotificationService
{
    public static function newOrderPlaced(Order $order): void
    {
        User::find(1)->notify(new NewOrderNotification($order));
    }

    public static function newCommentCreated(mixed $model): void
    {
        User::find(1)->notify(new NewCommentNotification($model));
    }

    public static function newUserRegistered(User $user): void
    {
        User::find(1)->notify(new UserRegistrationNotification($user));
    }

    public static function newPaidOrder(Order $order): void
    {
        User::find(1)->notify(new NewPaidOrderNotification($order));
    }

    public static function newFailedPayment(Order $order): void
    {
        User::find(1)->notify(new FailedPaymentNotification($order));
    }

    public static function newExerciseUploaded(Exercise $exercise): void
    {
        User::find(1)->notify(new NewExerciseNotification($exercise));
    }

    public static function dailyStats(): void
    {
        $stats = new ReportService();
        User::find(1)->notify(new DailyReportNotification($stats->daily()->report()));
    }

     public static function weeklyStats(): void
    {
        $stats = new ReportService();
        User::find(1)->notify(new DailyReportNotification($stats->weekly()->report()));
    }

     public static function monthlyStats(): void
    {
        $stats = new ReportService();
        User::find(1)->notify(new DailyReportNotification($stats->monthly()->report()));
    }
}
