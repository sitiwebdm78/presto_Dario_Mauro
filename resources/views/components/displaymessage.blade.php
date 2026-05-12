@if (session('message') || session('success'))
<div class="flash-message-container mt-4 pt-4">
    <div class="alert alert-success display-6 text-center flash-message-success">
        <h1 class="mt-1">{{ session('message') ?? session('success') }}</h1>
    </div>
</div>
@endif