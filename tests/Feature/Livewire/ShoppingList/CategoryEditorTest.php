<?php

namespace Tests\Feature\Livewire\ShoppingList;

use App\Livewire\ShoppingList\CategoryEditor;
use App\Models\Category;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryEditorTest extends TestCase
{
    use RefreshDatabase;

    // public function test_renders_successfully()
    // {
    //     Livewire::test(CategoryEditor::class)
    //         ->assertStatus(200);
    // }

    public function test_it_renders_the_component()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create(['owner_id' => $user->id]);
        $category = Category::factory()->create(['shopping_list_id' => $list->id]);

        $this->actingAs($user);

        Livewire::test(CategoryEditor::class, ['category' => $category])
            ->assertSee(__('Product'))
            ->assertSee(__('There are no products in this category. Create one above.'));
    }

    // public function test_it_requires_a_product_name()
    // {
    //     $user = User::factory()->create();
    //     $list = ShoppingList::factory()->create(['owner_id' => $user->id]);
    //     $category = Category::factory()->create(['shopping_list_id' => $list->id]);

    //     $this->actingAs($user);

    //     Livewire::test(CategoryEditor::class, ['category' => $category])
    //         ->set('name', '')
    //         ->call('newProduct')
    //         ->assertHasErrors(['name' => 'required']);
    // }

    // public function test_it_creates_a_product()
    // {
    //     $user = User::factory()->create();
    //     $list = ShoppingList::factory()->create(['owner_id' => $user->id]);
    //     $category = Category::factory()->create(['shopping_list_id' => $list->id]);

    //     $this->actingAs($user);

    //     Livewire::test(CategoryEditor::class, ['category' => $category])
    //         ->set('name', 'Milk')
    //         ->call('newProduct');

    //     $this->assertDatabaseHas('products', [
    //         'category_id' => $category->id,
    //         'name' => 'Milk',
    //     ]);
    // }

    public function test_it_deletes_a_category()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create(['owner_id' => $user->id]);
        $category = Category::factory()->create([
            'shopping_list_id' => $list->id,
            'name' => 'Vegetables',
        ]);

        $this->actingAs($user);

        Livewire::test(CategoryEditor::class, ['category' => $category])
            ->call('delete', $category->id);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
