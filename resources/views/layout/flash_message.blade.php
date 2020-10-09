@if(session()->has('message'))
    <div class="alert alert-success col-12">
        <p>{{ session('message') }}</p>
    </div>
@endif
