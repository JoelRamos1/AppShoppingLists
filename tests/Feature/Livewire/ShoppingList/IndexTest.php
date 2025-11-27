<?php

namespace Tests\Feature\Livewire\ShoppingList;

use App\Livewire\ShoppingList\Index;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_empty_message_when_no_lists_exist()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(Index::class)
            ->assertSee(__('You have not created any lists'));
    }

    public function test_it_shows_user_shopping_lists()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create([
            'owner_id' => $user->id,
            'title' => 'Weekly Groceries',
        ]);

        $this->actingAs($user);

        Livewire::test(Index::class)
            ->assertSee('Weekly Groceries')
            ->assertSee(__('Created'));
    }

    public function test_it_deletes_a_shopping_list_and_redirects()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create([
            'owner_id' => $user->id,
        ]);

        $this->actingAs($user);

        Livewire::test(Index::class)
            ->call('delete', $list->id)
            ->assertRedirect('/shopping-lists/index');

        $this->assertDatabaseMissing('shopping_lists', [
            'id' => $list->id,
        ]);
    }

    public function test_renders_successfully()
    {
        Livewire::test(Index::class)
            ->assertStatus(200);
    }
}
