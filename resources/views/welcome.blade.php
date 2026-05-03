<x-layout>
    <x-displaymessage />
    <x-displayerror />
    <x-navbar :bkg="'bkgylw'" :text="'txtblk'" />
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
