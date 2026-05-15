@props(['article', 'bkg' => 'bkgylw', 'text' => 'txtblu'])

<div class="card m-auto shadow text-center mb-3 {{$bkg}} {{$text}}" style="max-width: 25rem;">
    <img src="{{ $article->images->isNotEmpty() ? Storage::url($article->images->first()->path) : 'https://picsum.photos/288' }}"
         class="card-img-top" 
         style="height: 200px; object-fit: cover;"
         alt="Immagine dell'articolo {{ $article->title }}">
    <div class="card-body">
        <h4 class="card-title {{$text}}">{{ $article->title }}</h4>
        <h6 class="card-subtitle {{$text}} mb-2">{{ $article->price }} €</h6>
        <p class="card-text {{$text}}">{{ Str::limit($article->description, 100) }}</p>
        <div class="d-flex justify-content-evenly align-items-center mt-3">
            <a href="{{route('show.article', compact('article'))}}" class="btn btn-primary">Dettaglio</a>
            <a href="{{route('bycategory', ['category' => $article->category])}}" class="btn btn-outline-info">{{ $article->category->name }}</a>
        </div>
    </div>
</div>