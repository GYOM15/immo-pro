<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){    
        $properties = Property::with('pictures')->available()->recent()->limit(4)->get();
        return view('home', [
            'properties' => $properties
        ]);
    }
}

