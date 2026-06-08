<?php

namespace Tests\Feature\Livewire\ShoppingList;

use App\Livewire\ShoppingList\Show;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    // public function test_renders_successfully()
    // {
    //     Livewire::test(Show::class)
    //         ->assertStatus(200);
    // }

    public function test_it_renders_the_component()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create([
            'owner_id' => $user->id,
            'title' => 'My Shopping List',
        ]);

        $this->actingAs($user);

        Livewire::test(Show::class, ['id' => $list->id])
            ->assertSee('My Shopping List')
            ->assertSee(__('Add Category'))
            ->assertSee(__('There are no categories in this shopping list. Create one above.'));
    }

    public function test_it_requires_a_category_name()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create(['owner_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test(Show::class, ['id' => $list->id])
            ->set('name', '')
            ->call('save')
            ->assertHasErrors(['name' => 'required']);
    }

    public function test_it_creates_a_category()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create(['owner_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test(Show::class, ['id' => $list->id])
            ->set('name', 'Fruits')
            ->call('save');

        $this->assertDatabaseHas('categories', [
            'shopping_list_id' => $list->id,
            'name' => 'Fruits',
        ]);
    }

    public function test_it_deletes_the_shopping_list()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create(['owner_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test(Show::class, ['id' => $list->id])
            ->call('deleteShoppingList')
            ->assertRedirect(route('shopping-lists.index'));

        $this->assertDatabaseMissing('shopping_lists', [
            'id' => $list->id,
        ]);
    }
}
