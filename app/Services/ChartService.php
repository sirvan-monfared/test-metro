<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartService
{
    public static function incomeChart($from, $to, $format_date = 'Y/m/d'): array
    {
        $orders = Order::query()
            ->notFree()
            ->paid()
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->groupBy('date')
            ->get([
                DB::raw('SUM(price) AS price'),
                DB::raw('DATE(created_at) AS date')
            ]);

        return [
            'xAxis' => $orders->pluck('date')
                ->map(fn($item) => self::toJalali($item, $format_date))
                ->toArray(),
            'yAxis' => $orders->pluck('price')->toArray()
        ];
    }

    public static function usersRegisterChart($from, $to, $format_date = 'Y/m/d'): array
    {
        $users = User::query()
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->groupBy('date')
            ->get([
                DB::raw('COUNT(id) AS total'),
                DB::raw('DATE(created_at) AS date')
            ]);

        return [
            'xAxis' => $users->pluck('date')
                ->map(fn($item) => self::toJalali($item, $format_date))
                ->toArray(),
            'yAxis' => $users->pluck('total')->toArray()
        ];
    }

    private static function toJalali($date, $format)
    {
        return Carbon::parse($date)->toJalali()->format($format);
    }
}
