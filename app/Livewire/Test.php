<?php

namespace App\Livewire;

use Livewire\Component;

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
