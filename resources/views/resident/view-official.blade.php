@extends('layouts.appres')
@section('content')
<div id="layoutSidenav_content" style="background-color: rgb(240,236,236);">
    <main>
        <div class="container-fluid px-4">
            <div class="d">
                <h1 class="mt-4">{{ ucwords(auth()->user()->roles) }} | <span style="font-size:22px;">View</span></h1>
            </div>
            <hr style="border:1px solid black;">
            <div class="container">
                <h1 class="text-center">Barangay Officials Organization Chart</h1>
                <div class="nav-classlink">
  <div class="nav" style="margin-top: 20px;">
    <ul class="nav nav-tabs" style="background-color: #f8f9fa; border-radius: 8px; padding: 10px;">
        <li class="nav-item">
            <a class="nav-link active" style="color:green; font-weight:bold;" aria-current="page"  href="{{route('resofficial.index')}}"style="color: #333; font-size: 16px;">Barangay Officials  </a>
        </li>
         <li class="nav-item">
            <a class="nav-link " aria-current="page"  href="{{route('resSKofficial.index')}}" style="color: #333; font-size: 16px; ">SK Officials</a>
        </li>
    </ul>
</div>
                  <div class="container mt-5">
    <div class="row justify-content-center">
        @if ($officials->isNotEmpty())
            <!-- Captain Section -->
            <div class="col-md-4 mb-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body text-center">
                        <img src="{{ $officials[0]->photo ? asset($officials[0]->photo) : asset('/sys_logo/logo.png') }}" 
                             alt="{{ $officials[0]->name }}" 
                             class="rounded-circle mb-3" 
                             width="100" 
                             height="100">
                        <h5 class="card-title">{{ $officials[0]->name }}</h5>
                        <p class="text-muted">{{ $officials[0]->position }}</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Email Address: <a href="mailto:{{ $officials[0]->email }}">{{ $officials[0]->email }}</a>
                            </li>
                            <li class="list-group-item">Contact Number: {{ $officials[0]->contact }}</li>
                            <li class="list-group-item">Bio: {{ $officials[0]->description }}</li>
                            <li class="list-group-item">Term: {{ $officials[0]->term }}</li>
                            <li class="list-group-item">
                                Status:<span style="color:white; padding:5px; border-radius:10px;" class="bg-success">Active</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Other Officials Section -->
            @foreach($officials->slice(1) as $index => $official)
                <div class="col-md-4 mb-4">
                    <!-- Apply the color from the colors array -->
                    <div class="card text-center shadow-sm" style="border-top: 5px solid {{ $colors[$index % count($colors)] }};">
                        <div class="card-body">
                            <img src="{{ $official->photo ? asset($official->photo) : asset('/sys_logo/logo.png') }}" 
                                 alt="{{ $official->name }}" 
                                 class="rounded-circle mb-3" 
                                 width="100" 
                                 height="100">
                            <h5 class="card-title">{{ $official->name }}</h5>
                            <p class="text-muted">{{ $official->position }}</p>
                            <p>Email Address:<a href="mailto:{{ $official->email }}"> {{ $official->email }}</a></p>
                            <p>Contact Number: {{ $official->contact }}</p>
                            <p>Bio: {{ $official->bio }}</p>
                            <p>Term: {{ $official->term }}</p>
                            <p>Status: <span style="color:white; padding:5px; border-radius:10px;" class="bg-success">Active</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <p class="text-center">No other officials to display.</p>
            </div>
        @endif
    </div>
</div>
</div>
</div>
</div>
</div>
</main>
</div>

<!-- Optional Custom CSS -->
<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-10px);
}

.card:hover .btn-group {
    display: block; 
}

    #layoutSidenav_content {
        background-color: #F0ECEC;
    }
    .card {
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-10px);
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .rounded-circle {
        border: 2px solid #17a2b8;
    }
    .card-title {
        font-weight: bold;
    }
    @media (max-width: 768px) {
        .col-md-6, .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

    
<script>
function toggleDetails(card) {
    const dropdown = card.querySelector('.details-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

    // Optionally, close other cards' dropdowns
    document.querySelectorAll('.card').forEach(function(otherCard) {
        if (otherCard !== card) {
            otherCard.querySelector('.details-dropdown').style.display = 'none';
        }
    });
}
</script>
<!-- Stylesheets and Scripts -->
<script src="{{ asset('assets/js/sb-script.js') }}"></script>
<link href="{{ asset('assets/css/sb-style.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">
<script src="{{ asset('assets/js/a-dash-script.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/tabulator-tables@5.5.0/dist/css/tabulator_bootstrap5.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tabulator-tables@5.5.0/dist/js/tabulator.min.js"></script>
@endsection
@section('title','Brgy. Officials')
