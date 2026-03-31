<?php

namespace App\Providers;

use App\Events\InvestmentEvent;
use App\Listeners\NotificationInvestmentListener;
use App\Listeners\WalletUpdateAfterInvestmentListener;
use App\Services\Matricule;
use App\Services\WalletService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton('matricule',fn()=>new Matricule(8));
        $this->app->singleton('walletservice',fn()=>new WalletService(Auth::user()));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(InvestmentEvent::class,[
            NotificationInvestmentListener::class,
            WalletUpdateAfterInvestmentListener::class,
        ]);
    }
}
