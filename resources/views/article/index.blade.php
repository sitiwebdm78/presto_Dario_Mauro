<x-layout>
    <x-navbar :bkg="'bkgblu'" :text="'txtwht'" />
    <div class="container-fluid ">
        <div class="row height-custom justify-content-center align-items-center text-center">
            <div class="col-12 mt-5 pt-3">
                <h1 class="display-1 txtblu ">{{ __('ui.Tutti gli articoli') }}</h1>
            </div>
        </div>
        <div class="row height-custom justify-content-center align-items-center py-5">
            @forelse ($articles as $article_to_check)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card m-auto shadow h-100 bkgblu txtwht" style="max-width: 25rem;">
                    
                    {{-- GRIGLIA IMMAGINI --}}
                    @if ($article_to_check->images->count())
                        <div class="row g-2 p-2">
                            @foreach ($article_to_check->images as $key => $image)
                                <div class="col-6 col-md-4 mb-2">
                                    <img src="{{ Storage::url($image->path) }}" class="img-fluid rounded shadow" alt="Immagine {{ $key + 1 }} dell'articolo {{ $article_to_check->title }}">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row g-2 p-2">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col-6 col-md-4 mb-2 text-center">
                                    <img src="https://picsum.photos/300" alt="immagine segnaposto" class="img-fluid rounded shadow">
                                </div>
                            @endfor
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <h4 class="card-title txtwht">{{ $article_to_check->title }}</h4>
                        <h6 class="card-subtitle txtwht mb-2">{{ $article_to_check->price }} €</h6>
                        <p class="card-text txtwht">{{ Str::limit($article_to_check->description, 100) }}</p>
                        <div class="d-flex justify-content-evenly align-items-center mt-3">
                            <a href="{{route('show.article', ['article' => $article_to_check])}}" class="btn btn-primary">Dettaglio</a>
                            <a href="{{route('bycategory', ['category' => $article_to_check->category])}}" class="btn btn-outline-info">{{ $article_to_check->category->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <h3 class="text-center">
                    Non sono ancora stati creati articoli
                </h3>
            </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{ $articles->links() }}
        </div>
    </div>
</x-layout>