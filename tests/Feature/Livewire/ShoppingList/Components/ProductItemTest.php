<?php

namespace Tests\Feature\Livewire\ShoppingList\Components;

use App\Livewire\ShoppingList\Components\ProductItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_checks_and_unchecks_a_product()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create(['owner_id' => $user->id]);
        $category = Category::factory()->create(['shopping_list_id' => $list->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Bread',
            'is_completed' => false,
        ]);

        $this->actingAs($user);

        Livewire::test(ProductItem::class, ['product' => $product])
            ->call('checkProduct', $product->id);

        $this->assertTrue($product->fresh()->is_completed);

        Livewire::test(ProductItem::class, ['product' => $product])
            ->call('checkProduct', $product->id);

        $this->assertFalse($product->fresh()->is_completed);
    }

    public function test_it_deletes_a_product()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create(['owner_id' => $user->id]);
        $category = Category::factory()->create(['shopping_list_id' => $list->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Eggs',
        ]);

        $this->actingAs($user);

        Livewire::test(ProductItem::class, ['product' => $product])
            ->call('deleteProduct', $product->id);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function it_updates_a_product_name()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create(['owner_id' => $user->id]);
        $category = Category::factory()->create(['shopping_list_id' => $list->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Old Name',
        ]);

        $this->actingAs($user);

        Livewire::test(CategoryEditor::class, ['category' => $category])
            ->set("newProductNames.{$product->id}", 'New Name')
            ->call('updateProduct', $product->id);

        $this->assertEquals('New Name', $product->fresh()->name);
    }

    // public function test_renders_successfully()
    // {
    //     Livewire::test(ProductItem::class)
    //         ->assertStatus(200);
    // }

}
