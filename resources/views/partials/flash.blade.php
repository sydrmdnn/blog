@if (Session::has('success')) 

<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ __(Session::get('success')) }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif (Session::has('error')) 

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ __(Session::get('error')) }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif