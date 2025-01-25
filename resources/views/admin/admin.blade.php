<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.12"></script>
    <style>
      @layer reset{
          button{
              all: unset;
          }
      }
      .htmx-indicator{
        display: none;
      }
      .htmx-request .htmx-indicator{
        display: inline-block;
      }
     
  </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">Agence</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          @php
            // On recupère la route afin de pourvoir utiliser la classe active tout en bas
            $route = request()->route()->getName()
          @endphp
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a @class(['nav-link', 'active' => Str::contains($route, 'property.') ]) href="{{route('admin.property.index')}} ">Gerer les biens</a>
              </li>
              <li class="nav-item">
                <a @class(['nav-link', 'active' => Str::contains($route, 'option.') ]) href="{{route('admin.option.index')}}">Gerer les options</a>
              </li>
            </ul>

            {{--Le boutton de déconnexion---}}
            <div class="navbar-nav ms-auto">
              @auth
                <form action="{{route('logout')}}" method="POST" class="nav-item">
                  @method('delete')
                  @csrf
                  <button class="btn btn-primary nav-link">Se déconnecter</button>
                </form>
              @endauth
              @guest
                <div class="nav-item">
                  <a href="{{route('login')}} " class="nav-link">Se connecter</a>
                </div>
              @endguest
              
            </div>
          </div>
        </div>
      </nav>

    <div class="container mt-5">
      
        @include('shared.flash')

        @yield('content')
    </div>
    

    <script>
      //Pour customiser la partie de selection des options
      new TomSelect('select[multiple]', {plugins: {remove_button:{title: 'Supprimer'} }} )
    </script>

</body>
</html>