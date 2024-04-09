@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif

@if(session()->has('success'))
    <p class="alert alert-success">{{ session('success') }}</p>
@endif
@if(session()->has('danger'))
    <p class="alert alert-danger">{{ session('danger') }}</p>
@endif
