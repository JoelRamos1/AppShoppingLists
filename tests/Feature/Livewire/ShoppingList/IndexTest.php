<?php

namespace Tests\Feature\Livewire\ShoppingList;

use App\Livewire\ShoppingList\Index;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{

    public function test_renders_successfully()
    {

        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => 'usertesting',
        ]);


        ShoppingList::factory(10)->create();

        // Livewire::test(Index::class)
        //     ->assertViewHas('shoppingLists', function($shoppingLists) {
        //         return count($shoppingLists) == 1;
        //     });

        $shoppingLists = ShoppingList::where('onwer', Auth::id())->get();

        Livewire::test(Index::class, compact('shoppingLists'))
            ->assertStatus(200);

        // $this->get('shopping-lists/index')
        //      ->assertSeeLivewire(Index::class);
    }
}
