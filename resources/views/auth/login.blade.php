@extends('base')

@section('title', 'Se connecter')

@section('content')

<div class="container mt-4">
    <h1>@yield('title')</h1>
    <div class="card-body">
        @include('shared.flash')
        <form action="{{ route('login') }} " method="post" class = "vstack gap-3">

            @csrf

            @include('shared.input', ['type' => 'email', 'class' => 'col','label' => 'Email', 'name' => 'email'])
            @include('shared.input', ['type' => 'password', 'class' => 'col','label' => 'Mot de passe', 'name' => 'password'])
           <div>
                <button class="btn btn-primary">
                    Se connecter
                </button>
           </div>
        </form>
    </div>

</div>

@endsection