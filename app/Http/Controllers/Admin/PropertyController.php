<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Models\Picture;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created_at', 'desc')->withTrashed()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Si on veut préremplir les champs, on procède de la sorte
        $property = new Property();
        $property->fill([
            'surface' => 40, 
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' =>0,
            'city' => 'Montréal',
            'postal_code' => 3400,
            'sold' => false
        ]);
        /** dd(Option::pluck('name', 'id'));
         * Quand on debug on peut voir que ça nous renvoi un tableau avec id comme premier champ et l'option comme valeur
        */
        return view('admin.properties.form', [
            
            // On doit aussi lui passer les options afin de pouvoir les récupérer dans la vue select
            'property' => $property,
            'options' => Option::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());
        $property->options()->sync($request->validated('options'));
        if($request->validated('pictures')){
            $property->attachFiles($request->validated('pictures'));
        }
        return to_route('admin.property.index') ->with('succes', 'Le bien a bien été crée');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->options()->sync($request->validated('options'));
        $property -> update($request->validated());
        if($request->validated('pictures')){
            $property->attachFiles($request->validated('pictures'));
        }
        return to_route('admin.property.index')->with('success', 'Le bien a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        Picture::destroy($property->pictures()->pluck('id'));
        $property->delete();
        return to_route('admin.property.index')->with('success', 'Le bien a bien été supprimé');
    }
}
