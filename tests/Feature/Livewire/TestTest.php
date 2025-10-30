<?php

use App\Livewire\Test;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Test::class)
        ->assertStatus(200);
});
