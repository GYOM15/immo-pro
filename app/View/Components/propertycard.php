<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Property;

class PropertyCard extends Component
{
    private Property $property;

    /**
     * Create a new component instance.
     *
     * @param Property $property
     * @return void
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.propertycard', [
            'property' => $this->property,
        ]);
    }
}
