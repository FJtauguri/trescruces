@extends('layouts.appres')

@section('content')
<div class="container">
    <h1 class="text-center">Barangay Officials Organization Chart</h1>

    <div class="row justify-content-center">
        @foreach($officials as $official)
        <div class="col-md-3 mb-4">
            <div class="card position-relative">
                <div class="card-header text-center">
                    <img src="{{ asset('/sys_logo/logo.png') }}" alt="{{ $official->name }}" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px;">
                    <h5 class="font-weight-bold">{{ $official->name }}</h5>
                    <span class="position">{{ $official->position }}</span>
                </div>
                <div class="card-body">
                    <p class="text-center">Hover to view details</p>
                </div>
                <div class="details-dropdown position-absolute" style="display: none; width: 200px;">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Email:</strong> {{ $official->email }}</p>
                            <p><strong>Contact:</strong> {{ $official->contact }}</p>
                            <p class="description"><strong>Bio:</strong> {{ $official->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.card {
    position: relative;
}

.card:hover .details-dropdown {
    display: block;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1;
}

.details-dropdown {
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
</style>
@endsection
