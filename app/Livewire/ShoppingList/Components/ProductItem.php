<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductItem extends Component
{
    public Product $product;

    public string $newName;

    public string $tagName;

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

        $this->validate([
            'newName' => 'required|string|max:255',
        ]);

        $this->product->update([
            'name' => $this->newName,
        ]);

        $this->dispatch('product-updated');
    }

    // No borra etiquetas
    public function deleteProduct()
    {
        $this->authorize('delete', $this->product->category->shoppingList);

        $this->product->delete();

        $this->dispatch('product-deleted', id: $this->product->id);
    }

    public function createTag()
    {
        $this->authorize('create', $this->product->category->shoppingList);

        $this->validate([
            'tagName' => 'required|string|max:20',
        ]);

        $this->product->tag()->create([
            'name' => $this->tagName,
        ]);

        $this->reset('tagName');

        $this->product->refresh();
    }

    public function render()
    {
        return view('livewire.shopping-list.components.product-item');
    }
}
