@error('error')
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
