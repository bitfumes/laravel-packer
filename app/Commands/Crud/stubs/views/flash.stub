@if($errors->count() > 0)
    @foreach($errors as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif


@if(session()->has('message'))
    <div class="alert alert-success">{{ session()->get('message') }}</div>
@endif
