@if (session('message'))
<div class="flash-message-container mt-4 pt-4" style="position: relative; height: 0; overflow: visible;">
    <div class="alert alert-success display-6 text-center flash-message-success">
     <h1 class="mt-1">{{session('message')}}</h1>
    </div>
</div>
@endif
