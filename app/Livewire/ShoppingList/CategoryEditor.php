<?php

namespace App\Livewire\ShoppingList;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryEditor extends Component
{
    public Category $category;

    #[Validate('required|string|max:255')]
    public string $name = '';

    // #[Validate('required|string|max:255')]
    public string $newCategoryName = '';

    public function mount(Category $category)
    {
        $this->category = $category->load('products');
    }

    #[On('product-deleted')]
    #[On('category-updated')]
    public function refreshProducts(int $id)
    {
        $this->category->refresh();
    }

    public function changeCategoryName()
    {
        $this->authorize('update', $this->category->shoppingList);

        $this->validate();

        $this->category->update([
            'name' => $this->newCategoryName,
        ]);

        $this->reset('newCategoryName');
        $this->category->refresh();

        $this->dispatch('category-updated', id: $this->category->id);
    }

    public function newProduct()
    {
        $this->validate();
        $this->authorize('create', $this->category->shoppingList);

        $this->category->products()->create([
            'name' => $this->name,
        ]);

        $this->category->refresh();
        $this->reset('name');

        $this->dispatch('product-added');
    }

    public function delete() {
        $this->authorize('delete', $this->category->shoppingList);

        $this->category->delete();

        $this->dispatch('category-delete', id: $this->category->id);
    }

    public function render()
    {
        return view('livewire.shopping-list.category-editor');
    }
}
