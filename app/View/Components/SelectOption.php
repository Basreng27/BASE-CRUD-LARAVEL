<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectOption extends Component
{
    public $name;
    public $value;
    public $options;
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $value = null, $options = [], $id = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->options = $options;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-option');
    }
}
