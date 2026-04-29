@if (session('message'))
<div class="flash-message-container" style="position: relative; height: 0; overflow: visible;">
    <div class="alert alert-success display-6 text-center flash-message-success">
        {{session('message')}}
    </div>
</div>
@endif