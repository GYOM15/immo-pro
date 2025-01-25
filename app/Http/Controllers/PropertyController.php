<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\View\View;
use App\Mail\PropertyContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;


class PropertyController extends Controller
{
    
    public function index(SearchPropertiesRequest $request){
        /** 
         * En laravel quand on appelle une methode inconnue comme paginate statiquement sur un model, il construit automatiquement un builder.
         * On va donc décomposer cela dans le but de notre recherche
         * NB: ici on utilise $request->validated() plutôt que $request->has() afin d'éviter l'erreur au niveau du prix, si rien n'est passé dans le navigateur
         * On peut faire de l'igerloading en passant la fonction with(options) à query pour précharger ce que l'on veut
         * Cela nous épargne de faire trop de réquêtes
         */ 
        $query = Property::query()->with('pictures')->recent()->available();
        // On vérifie si la réquête contien le prix
        if($price = $request->validated('price')){
            $query = $query->where('price', '<=', $price);
        } 

        if($surface = $request->validated('surface'))
        {
            $query = $query->where('surface', '>=', $surface);
        } 

        if($rooms = $request->validated('rooms'))
        {
            $query = $query->where('rooms', '>=', $rooms);
        } 

        if($title =$request->validated('title'))
        {
            $query = $query->where('title', 'like', "%{$title}%");
        }
        return view('property.index', [
            'properties' => $query->paginate(16),
            'input' => $request->validated() 
        ]);
    }

    public function show(String $slug, Property $property) : RedirectResponse | View{
        $expectedSlug = $property->getSlug();
        if($slug!=$expectedSlug){
           return to_route('property.show', [
               'slug' => $expectedSlug, 'property' => $property]);
       }
       
       return View( 'property.show', [
           'property' => $property
       ]);

    }

    public function contact(Property $property, PropertyContactRequest $request){
        Mail::send(new PropertyContactMail($property, $request->validated()));
        return back()->with('success', 'Votre demande de contact a bien été envoyé');
    }

}
