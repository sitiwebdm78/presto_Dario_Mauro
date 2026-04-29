 <x-layout>
    <x-navbar />
    <x-displaymessage />
    <x-displayerror />  
    <div class="container-fluid vh-100 bkgblu">
        <div class="row mb-5">
            <div class="col-12 vh-100">
                <h1 class="text-center mt-2 pt-3 txtwht">Registrati</h1>
                <div class="d-flex justify-content-center">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="formcustom centerform shadow-lg">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label ms-2 txtwht">Nome e Cognome</label>
                            <input type="text" name='name' class="form-control" id="name" value="{{old('name')}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label ms-2 txtwht">Insirisci la tua e-mail</label>
                            <input type="email" name='email' class="form-control" id="email" value="{{old('email')}}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label ms-2 txtwht">Inserisci una Password</label>
                            <input type="password" name='password' class="form-control" id="password" value="{{old('password')}}">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label ms-2 txtwht">Conferma Password</label>
                            <input type="password" name='password_confirmation' class="form-control" id="password_confirmation" value="{{old('password_confirmation')}}">
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="txtwht">Hai Già un Account?</p>
                                <a href="{{route('login')}}" class="btn btn-warning mb-3">Esegui il Login</a>
                            </div>
                            <div class="ms-auto">
                                <button type="submit" class="btn btn-primary mb-3">Registrati</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>


