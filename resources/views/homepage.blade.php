<x-layout>
    <x-navbar :bkg="'bkgylw'" :text="'txtblk'" />
    @if (session('message') || session('success'))
    <div class="flash-message-container mt-4 pt-4" style="margin-top: 1000px;">
        <div class="alert alert-success display-6 text-center flash-message-success">
            <h1 class="mt-1">{{ session('message') ?? session('success') }}</h1>
        </div>
    </div>
    @endif
    <div class="container-fluid text-center bg-multimedia">
        <div class="row vh-100 justify-content-center align-items-center"></div>
    </div>
    <div class="row height-custom justify-content-center align-items-center bkgylw py-5">
        @forelse ($articles as $article)
        <div class="col-12 col-md-3">
            <x-card :article="$article" :bkg="'bkgblk'" :text="'txtylw'" />
        </div>
        @empty
        <div class="col-12">
            <h3 class="text-center">Non sono ancora stati creati articoli</h3>
        </div>
        @endforelse
    </div>
    <x-footer :bkg="'bkgblk'" :text="'txtylw'"/>
</x-layout>
