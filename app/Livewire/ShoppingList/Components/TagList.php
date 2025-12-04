<?php

namespace App\Livewire\ShoppingList\Components;

use Livewire\Component;

class TagList extends Component
{
    public $tag;

    public function deleteTag()
    {
        $this->authorize('delete', $this->tag->product->category->shoppingList);

        $this->tag->delete();

        $this->dispatch('tag-delete', id: $this->tag->id);
    }

    public function render()
    {
        return view('livewire.shopping-list.components.tag-list');
    }
}
