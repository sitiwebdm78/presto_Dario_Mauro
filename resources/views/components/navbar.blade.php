@props(['bkg' => 'bkgylw', 'text' => 'txtblu', 'title' => 'Benvenuto'])
<nav class="navbar navbar-expand-lg fixed-top {{$bkg}} {{$text}}">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{$text}} @if(Route::currentRouteName() === 'homepage') active_custom @endif" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$text}} @if(Route::currentRouteName() === 'index.article') active_custom @endif" href="{{ route('index.article') }}">{{ __('ui.Tutti gli articoli') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link {{$text}} dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('ui.Categorie') }}
                    </a>
                    <ul class="dropdown-menu {{$bkg}}">
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{route('bycategory', ['category' => $category])}}" class="dropdown-item text-capitalize">
                                {{ __('ui.' . $category->name) }}
                            </a>
                        </li>
                        @if (!$loop->last)
                        <li><hr class="dropdown-divider"></li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{$text}} @if(Route::currentRouteName() === 'create.article') active_custom @endif" href="{{ route('create.article') }}">{{ __('ui.Inserisci Articolo') }}</a>
                </li>
                @if (Auth::user()->is_revisor)
                <li class="nav-item">
                    <a class="nav-link {{$text}} @if(Route::currentRouteName() === 'revisor.index') active_custom @endif btn btn-outline-success btn-sm position-relative w-sm-25"
                    href="{{ route('revisor.index') }}">{{ __('ui.Zona Revisore') }}
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{\App\Models\Article::toBeRevisedCount()}}
                    </span>
                    </a>
                </li>
                @endif
                @endauth
                <form class="d-flex ms-3" role="search" action="{{ route('article.search') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="query" class="form-control" placeholder="Search" aria-label="search">
                        <button type="submit" class="input-group-text btn btn-outline-success" id="basic-addon2">Search</button>
                    </div>
                </form>
            </ul>

            <!-- Menu a destra -->
            @auth
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{$text}}" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('ui.Benvenuto') }} {{Auth::user()->name}}
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
                    <a class="nav-link {{$text}}" href="{{route('register')}}">{{ __('ui.Registrati') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$text}}" href="{{route('login')}}">{{ __('ui.Accedi') }}</a>
                </li>
            </ul>
            @endguest
            <li class="nav-item dropdown me-2 ms-3" style="list-style-type: none;">
                <a class="nav-link dropdown-toggle {{$text}}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    🌐 {{ __('ui.Lingua') }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end {{$bkg}}">
                    <li class="{{$text}}"><x-flags lang="it" /> Italiano</li>
                    <li class="{{$text}}"><x-flags lang="uk" /> Inglese</li>
                    <li class="{{$text}}"><x-flags lang="es" /> Spagnolo</li>
                </ul>
            </li>
        </div>
    </div>
</nav>
