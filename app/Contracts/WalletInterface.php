<?php

namespace App\Contracts;

interface WalletInterface
{
    public function checkwallet();
    public function createwallet();
    public function getwallet();
    public function updatewallet($amount);
}