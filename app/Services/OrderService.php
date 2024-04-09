<?php
namespace App\Services;

use App\Filters\Entities\OrderFilter;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderService {

    public static function filter(OrderFilter $filter)
    {
        return Order::with('user')->filter($filter)->latest()->paginate(20);
    }

    public static function potentials(): \Illuminate\Database\Eloquent\Collection
    {
        return Order::notPaid()->with('user', fn($q)=> $q->withCount('courses'))->whereHas('user', function($q) {
            return $q->withCount('courses')->having('courses_count', '<', 2)->whereNotNull('phone');
        })->groupBy('user_id')->get();
    }

    public static function storeOrderFromShoppingCart($coupon_data = [])
    {
        return Order::create([
            'order_token' => Order::generateOrderToken(),
            'user_id' => auth()->user()->id,
            'reference_token' => null,
            'price' => cart()->finalPrice(),
            'gateway' => null,
            'content' => serialize(cart()->prepareToStore($coupon_data))
        ]);
    }


    public static function totalIncome($from, $to): int
    {
        return Order::query()
            ->notFree()
            ->paid()
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->sum('price');
    }

    public static function failedOrdersBetween($from, $to): int
    {
        return Order::query()
            ->notFree()
            ->notPaid()
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->count('id');
    }
}
