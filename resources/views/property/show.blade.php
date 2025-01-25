@extends('base')

@section('titel', $property-> title)

@section('content')

<div class="container p-5">
    <h1>{{$property->title}}</h1>
    <h2> {{$property->surface}} m2 </h2>

    <div class="text-primary fw-bold" style="font-size: 4rem ;">
        {{number_format($property->price, thousands_separator: ' ')}} $
    </div>
        
    <hr>

    <div class="container mt-4">
        <div class="row">
            <div class="col-8">
                <div id="carousel" class="carousel slide" data-bs-ride="carousel" style="max-width: 800px">
                    <div class="carousel-inner">
                        @foreach ($property ->pictures as $k => $picture )
                            <div class="carousel-item {{$k === 0 ? 'active' : ''}}">
                                <img src="{{$picture ->getImageUrl(800, 530)}}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                </div>
            </div>
            <div class="col-4">
                <h4>Intéressé par ce bien ?</h4>
                {{-- On pourrait bien gérer de telle sorte que s'il existe le message flash, on fait disparaitre le formulaire --}}
                @include('shared.flash')

                <form action="{{ route('property.contact', $property)}} " method="POST" class="vstack gap-3">
                        @csrf
                    <div class="row">
                        <x-input class="col" name="firstname" label="Prénom" value="John"/>
                        <x-input class="col" name="lastname" label="Nom" value="Doe"/>
                    </div>
                    <div class="row">
                        <x-input class="col" name="phone" label="Téléphone" value="22 33 345 55"/>
                        <x-input class="col" name="email" type='email' label="Email" value="John@doe.com"/>
                    </div>
                    <x-input class="col" name="message" type='textarea' label="Votre message" value="Voici mon message"/>
                    <div>
                        <button class="btn btn-primary">
                            Nous contacter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <p>{!! nl2br($property ->description) !!} </p>
        <div class="row">
            <div class="col-8">
                <h2>Caractéristique</h2>
                <table class="table table-striped">
                    <tr>
                        <td>Surface habitable</td>
                        <td>{{$property->surface}} m2 </td>
                    </tr>
                    <tr>
                        <td>Pièces</td>
                        <td>{{$property->rooms}} </td>
                    </tr>
                    <tr>
                        <td>Chambres</td>
                        <td>{{$property->bedrooms}} </td>
                    </tr>
                    <tr>
                        <td>Etage</td>
                        <td>{{$property->floor ?: 'Rez de chaussé'}} </td>
                    </tr>
                    <tr>
                        <td>Localisation</td>
                        <td>{{$property->city}} ({{$property->postal_code}}) </td>
                    </tr>
                    
                </table>
            </div>
            <div class="col-4">
                <h2>Spécificités</h2>
                <ul class="list-group">
                    @foreach ($property->options as $option )
                        <li class="list-group-item">
                            {{$option->name}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection