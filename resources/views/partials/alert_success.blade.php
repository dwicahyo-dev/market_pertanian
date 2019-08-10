@if(session()->has('success'))
<div class="alert alert-primary alert-dismissible alert-has-icon show fade">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button> {{ session()->get('success') }}
    </div>
</div>
@endif