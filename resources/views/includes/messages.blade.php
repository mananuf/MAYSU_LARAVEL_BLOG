@if (count($errors) > 0)    

    @foreach ($errors as $error)
    <div class="alert alert-danger alert-dismissible fade show w-50 mt-2" role="alert">
        <strong>ERROR:</strong><span> {{$error}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach

@endif


@if (session('success'))
    
    <div class="alert-container">
        <div class="alert alert-success">
            <span class="closebtn">&times;</span>  
            {{ session('success') }}
        </div>
    </div>

@endif


@if (session('error'))
    
    <div class="alert-container">
        <div class="alert alert-danger">
            <span class="closebtn">&times;</span>  
            {{ session('error') }}
        </div>
    </div>

@endif

{{-- @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show w-50 mt-2" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif  --}}
    
{{-- @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show w-50 mt-2" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}
     
@if ($message = Session::get('warning'))
<div class="alert-container">
    <div class="alert alert-warning">
        <span class="closebtn">&times;</span>  
        {{ $message }}
    </div>
</div>
@endif
     
@if ($message = Session::get('info'))
<div class="alert-container">
    <div class="alert alert-info">
        <span class="closebtn">&times;</span>  
        {{ $message }}
    </div>
</div>
@endif