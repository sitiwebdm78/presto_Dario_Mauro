@props(['bkg' => 'bkgylw', 'text' => 'txtblu', 'title' => 'Benvenuto'])
<nav class="navbar navbar-expand-lg fixed-top {{$bkg}} {{$text}}">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{$text}} @if(Route::currentRouteName() === 'homepage') active_custom @endif" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$text}} @if(Route::currentRouteName() === 'index.article') active_custom @endif" href="{{ route('index.article') }}">Tutti gli articoli</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link {{$text}} dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorie
                    </a>
                    <ul class="dropdown-menu {{$bkg}}">
                        @foreach ($categories as $category)
                            <li><a href="{{route('bycategory', ['category' => $category])}}" class="dropdown-item text-capitalize">{{ $category->name }}</a></li>
                            @if (!$loop->last)
                                <li><hr class="dropdown-divider"></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{$text}} @if(Route::currentRouteName() === 'create.article') active_custom @endif" href="{{ route('create.article') }}">Inserisci Articolo</a>
                </li>
                @endauth
            </ul>
            
            <!-- Menu destra (User/Login) -->
            @auth
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{$text}}" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Benvenuto {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endauth
            
            @guest
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{$text}}" href="{{route('register')}}">Registrati</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$text}}" href="{{route('login')}}">Accedi</a>
                </li>
            </ul>
            @endguest
        </div>
    </div>
</nav>