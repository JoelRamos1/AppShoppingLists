<?php

namespace App\Livewire\ShoppingList\Components;

use Livewire\Component;

class TagList extends Component
{
    public $tag;

    public function render()
    {
        return view('livewire.shopping-list.components.tag-list');
    }
}
