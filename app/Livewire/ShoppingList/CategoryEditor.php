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
    public $name = '';

    public function mount(Category $category)
    {
        $this->category = $category->load('products');
    }

    #[On('product-deleted')]
    public function refreshProducts(int $id)
    {
        $this->category->refresh();
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

    public function render()
    {
        return view('livewire.shopping-list.category-editor');
    }
}
