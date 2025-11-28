<?php

namespace Tests\Feature\Livewire\ShoppingList;

use App\Livewire\ShoppingList\Create;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        Livewire::test(Create::class)
            ->assertStatus(200);
    }

    public function test_it_shows_the_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(Create::class)
            ->assertSee(__('New Shopping List'))
            ->assertSee(__('Title'))
            ->assertSee(__('Create'));
    }

    public function test_it_requires_a_title()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(Create::class)
            ->set('title', '')
            ->call('save')
            ->assertHasErrors(['title' => 'required']);
    }

    public function test_it_creates_a_shopping_list_and_redirects()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(Create::class)
            ->set('title', 'Weekend Groceries')
            ->call('save')
            ->assertRedirect(route('shopping-lists.show', ShoppingList::first()->id));

        $this->assertDatabaseHas('shopping_lists', [
            'title' => 'Weekend Groceries',
            'owner_id' => $user->id,
        ]);

        $this->assertTrue(
            ShoppingList::first()->members()->where('user_id', $user->id)->exists()
        );
    }
}
