<?php

namespace App\Providers;

use App\Enums\Status;
use App\Kodesign\Cart\Cart;
use App\Kodesign\Gateway\PayPing;
use App\Models\User;
use App\Support\DisposableEmailChecker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->environment('production')) {
            app()->usePublicPath(base_path('../../public_html'));
        }

        $this->app->singleton(Cart::class);

        $this->app->bind('DisposableEmailChecker', fn() => new DisposableEmailChecker());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Schema::defaultStringLength(191);
        URL::forceScheme('https');
        Model::unguard();

        Paginator::useTailwind();

        Gate::before(fn (User $user) => $user->isAdmin());

        Gate::define('status-active', function (User $user, $model) {
            return $model->status === Status::ACTIVE;
        });

        Carbon::macro('toJalali', static function ($format = null) {
            if ($format) {
                return verta(self::this())->format($format);
            }

            return verta(self::this());
        });
    }
}
