<x-layout>
    <x-navbar />
    <x-displaymessage />
    <x-displayerror />
    <div class="container-fluid vh-100 bkgblu">
        <div class="row mb-5">
            <div class="col-12 vh-100">
                <h1 class="text-center mt-5 pt-5 txtwht">Accedi alla Tua Area Riservata</h1>
                <div class="d-flex justify-content-center">
                    <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data" class="formcustom shadow-lg">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label ms-2 txtwht">Insirisci la tua e-mail</label>
                            <input type="email" name='email' class="form-control" id="email" value="{{old('email')}}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label ms-2 txtwht">Inserisci la Password</label>
                            <input type="password" name='password' class="form-control" id="password" value="{{old('password')}}">
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="txtwht">Non hai un Accout?</p>
                                <a href="{{route('register')}}" class="btn btn-warning mb-3">Registrati</a>
                            </div>
                            <div class="ms-auto">
                                <button type="submit" class="btn btn-primary mb-3">Accedi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
