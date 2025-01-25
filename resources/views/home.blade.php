@extends('base')

@section('content')

    <div class="bg-light mb-5 p-5 text-center">
        <div class="container">
            <h1>Agence Immo</h1>
            <p>Nous sommes heureux de vous accueillir parmi nos étudiants et de confirmer votre admission au baccalauréat
                en administration (concentration en gestion des ressources humaines) (7564). Toutefois, cette admission est conditionnelle à la réussite des cours mentionnés:</p>
        </div>       
    </div>

    <div class="container">
        <h2>Nos derniers biens</h2>
        <div class="row">
            @foreach ($properties as $property )
                <div class="col">
                    <x-propertycard :property="$property"/>
                </div>  
            @endforeach
            
        </div>
    </div>

@endsection