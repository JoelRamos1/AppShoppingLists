<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Test extends Component
{
    public $title = 'Title';

    public $newTitle;

    public function changeNewTitle()
    {
        $this->title = $this->newTitle;
    }

    public function render()
    {
        return view('livewire.test');
    }
}
