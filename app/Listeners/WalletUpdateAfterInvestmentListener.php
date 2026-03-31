<?php

namespace App\Listeners;

use App\Models\Wallet;
use App\Models\Project;
use App\Events\InvestmentEvent;
use App\Services\WalletService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WalletUpdateAfterInvestmentListener
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
        //créditer le solde de la compagnie
        $project = Project::find($event->investment->reference_project);
        $user = $project->company->users;
        (new WalletService($user))->updateWallet($event->investment->amount);
    }
}
