<?php

namespace App\Listeners;

use App\Events\InvestmentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\InvestmentRequestNotification;

class NotificationInvestmentListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function __invoke(InvestmentEvent $event): void
    {
        //notifier à l'investisseur
        $event->user->notify(new InvestmentRequestNotification($event->investment));
        //notifier à la compagnie
        $company = $event->investment->project->company->users;
        $company->notify(new InvestmentRequestNotification($event->investment));
    }
}
