<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowBalance extends Component
{
    public $balance;

    public function mount($balance)
    {
        $this->balance = $balance;
    }
    public function render()
    {
        /*return <<<'blade'
            <div>
                {{$balance}}
            </div>
        blade;*/
        return $this->balance;
    }
}
