<?php

Artisan::command('syncCurrentBalance', function () {
    App\Models\Account::syncCurrentBalance();
})->describe('Sync Current Balance of Account');