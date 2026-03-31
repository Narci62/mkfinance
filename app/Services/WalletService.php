<?php

namespace App\Services;

use App\Contracts\WalletInterface;
use App\Models\User;

class WalletService implements WalletInterface
{
    
    public function __construct(public User $user)
    {
    }

    public function checkwallet()
    {
        return $this->user->wallet()->exists();
    }

    public function createwallet()
    {
        if(!$this->checkwallet()){
            $this->user->wallet()->create([
                'holder'=> $this->user->id,
                'solde'=> 0
            ]);
            return true;
        }
        return false;
    }

    public function getwallet(){
      return $this->user->wallet;
    }

    public function updateWallet($amount): void
    {
        $monwallet = $this->getwallet();
        $monwallet->solde += $amount;
        $monwallet->save();
    }
}
