<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Filters\Entities\OrderFilter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use App\Services\TelegramNotificationService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrderFilter $filter)
    {
        return view('admin.order.index', [
            'orders' => OrderService::filter($filter)
        ]);
    }

    public function update(Order $order)
    {
        abort_if($order->isPaid(), 403);

        $this->enrollToCourses($order, $order->id);
        $this->setOrderAsPaid($order);

        TelegramNotificationService::newPaidOrder($order->fresh());

        return back()->withSuccess("پرداخت سفارش شناسه {$order->id} با موفقیت ثبت شد");
    }

    public function show(Order $order)
    {
        return view('admin.order.show', [
           'order' => $order
        ]);
    }

    public function destroy(Order $order)
    {
        if ($order->isPaid()) {
            return response("امکان حذف این سفارش وجود ندارد", 400);
        }

        $order->delete();
        session()->flash('success', "سفارش با شناسه {$order->id} با موفقیت حذف شد");
        return response('', 200);
    }

    public function potentialUsers()
    {
        $orders = OrderService::potentials();
        foreach ($orders as $order) {
            echo enDigits($order->user->phone)."<br>";
        }
        die();
    }

    private function enrollToCourses($order, $order_id)
    {
        abort_if(! $order->user, 404);

        foreach ($order->items() as $item) {
            $order->user->enrollIn($item->model(), ['order_id' => $order_id]);
        }
    }


    private function setOrderAsPaid(Order $order): void
    {
        $order->update([
            'support_token' => $order->order_token
        ]);
        $order->makePaid();
    }
}
