@if (session('success'))
    <div class="card">
    <div class="card-body alert alert-success no-margin">
        {{ session('success') }}
    </div>
    </div>
@elseif (session('warning'))
    <div class="card">
    <div class="card-body alert alert-warning no-padding">
        {{ session('warning') }}
    </div>
    </div>
@endif