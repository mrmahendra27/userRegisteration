@if(session('success'))
<div class="alert alert-success alert-dismissible show fade padding-20">
    <div class="alert-body">
        <i class="far fa-thumbs-up"></i>
        <button class="close" data-dismiss="alert" aria-label="Close">
            <span>&times;</span>
        </button>
        {{ session('success') }}
    </div>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible show fade padding-20">
    <div class="alert-body">
        <i class="far fa-thumbs-down"></i>
        <button class="close" data-dismiss="alert" aria-label="Close">
            <span>&times;</span>
        </button>
        {{ session('error') }}
    </div>
</div>
@endif
