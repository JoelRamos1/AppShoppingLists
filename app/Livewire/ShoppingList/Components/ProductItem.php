<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductItem extends Component
{
    public $product;

    public $newName;

    public $tagName = '';

    public function mount(Product $product)
    {
        $this->product = $product->load('tag');
    }

    #[On('tag-delete')]
    public function refreshProduct(int $id)
    {
        $this->product->refresh();
    }

    public function checkProduct()
    {
        $this->authorize('update', $this->product->category->shoppingList);

        $this->product->update([
            'is_completed' => ! $this->product->is_completed,
        ]);

        $this->dispatch('product-updated');
    }

    public function updateProduct()
    {
        $this->authorize('update', $this->product->category->shoppingList);

        $this->product->update([
            'name' => $this->newName,
        ]);
    }

    public function deleteProduct()
    {
        $this->authorize('update', $this->product->category->shoppingList);

        $this->product->delete();

        $this->dispatch('product-deleted', id: $this->product->id);
    }

    public function createTag()
    {
        $this->authorize('create', $this->product->category->shoppingList);

        $this->product->tag()->create([
            'name' => $this->tagName,
        ]);

        $this->reset('tagName');

        $this->product->load('tag');

        $this->dispatch('tag-created');
    }

    public function render()
    {
        return view('livewire.shopping-list.components.product-item');
    }
}
