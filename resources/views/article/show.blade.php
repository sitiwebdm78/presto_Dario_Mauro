<x-layout>
    <x-navbar />
    <div class="container">
        <div class="row height-custom justify-content-center align-items-center text-center">
            <div class="col-12 mt-5 pt-5">
                <h1 class="display-4">Dettaglio dell'articolo: {{ $article->title }}</h1>
            </div>
        </div>
        <div class="row height-custom justify-content-center py-5">
            
            {{-- NUOVO BLOCCO CAROSELLO CON IMMAGINI DAL DATABASE --}}
            <div class="col-12 col-md-6 mb-3">
                @if ($article->images->count() > 0)
                    <div id="carouselExample{{ $article->id }}" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach ($article->images as $key => $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ $image->getUrl(308, 300) }}" class="d-block w-100 rounded shadow" alt="Immagine {{ $key + 1 }} dell'articolo {{ $article->title }}">
                                </div>
                            @endforeach
                        </div>
                        @if ($article->images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{ $article->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{ $article->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                @else
                    <img src="https://picsum.photos/480" class="d-block w-100 rounded shadow" alt="Nessuna foto inserita">
                @endif
            </div>

            <div class="col-12 col-md-6 mb-3 height-custom text-center">
                <h2 class="display-5"> <span class="fw-bold">Titolo: </span> {{ $article->title }}</h2>
                <div class="d-flex flex-column justify-content-center h-75">
                    <h4 class="fw-bold">Prezzo: {{ $article->price }} €</h4>
                    <h5>Descrizione: </h5>
                    <p>{{ $article->description }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>