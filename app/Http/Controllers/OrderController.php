<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\BreadCrumbService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('front.dashboard.order.index', [
            'orders' => Order::forUser(auth()->user()->id),
            'breadCrumbs' => BreadCrumbService::dashboardOrderHistory()->items()
        ]);
    }

    public function show(Order $order): Factory|View|Application
    {
        Gate::denyIf($order->user_id !== auth()->id() || !$order->isPaid());

        abort_if(! $order->enrollment(), 404);

        return view('front.dashboard.order.show', [
            'order' => $order,
            'enrollment' => $order->enrollment(),
            'breadCrumbs' => BreadCrumbService::dashboardOrder($order)->items()
        ]);
    }
}
