<div class="container-fluid min-vh-100 bkgblu position-relative">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="text-center mt-2 pt-3 txtwht">Pubblica il Tuo Articolo</h1>       
            <x-displaymessage />
            <div class="d-flex justify-content-center ">
                <form class="p-4 rounded-5 shadow bg-warning formcustom" wire:submit.prevent="save">
                    <h5 class="text-center txtblk">CREA IL TUO ARTICOLO</h5>
                    <div class="mb-3">
                        <label for="title" class="form-label txtblk">Titolo</label>
                        <input type="text" class="form-control" @error('title') is-invalid @enderror id="title" wire:model.blur="title">
                        @error('title')
                        <p class="fst-italic text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label txtblk">Descrizione</label>
                        <textarea class="w-100 h-50" @error('description') is-invalid @enderror id="description" cols="30" rows="7" wire:model.blur ="description"></textarea>
                        @error('description')
                        <p class="fst-italic text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <p></p>
                    <div class="mb-3">
                        <select id="category" class="form-select" wire:model="category">
                            <option>Seleziona una Categoria</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id }}"> {{$category->name }} </option>  
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 text-end">
                        <label for="price" class="form-label txtblk d-block me-5 pe-5">Prezzo</label>
                        <input type="text" wire:model="price"
                        class="form-control d-inline-block w-auto @error('price') is-invalid @enderror"
                        id="price"> €
                        @error('price')
                        <p class="fst-italic text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">Crea Articolo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
    
    
    