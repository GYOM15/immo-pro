<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    private $type ;
    private $class;
    private $name ;
    private $value ;
    private $label ;

    /**
     * Create a new component instance.
     */
    public function __construct($type='text', $class = null, $name= '', $value= '', $label= '')
    {
        $this->type = $type;
        $this->class = $class;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label ? $label : ucfirst($this->name);

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input', [
            'type' => $this->type,
            'class' => $this->class,
            'name' => $this->name,
            'value' => $this->value,
            'label' => $this->label,
        ]);
    }
}
