<?php

use App\Livewire\ShoppingList\TestLogin;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(TestLogin::class)
        ->assertStatus(200);
});
