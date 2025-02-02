@extends('layouts.app')

@section('content')
@include('layouts.sidebar')
<div id="layoutSidenav_content" style="background-color: rgb(240,236,236);">
    <main>
        <div class="container-fluid px-4">
            <div class="d">
                <h1 class="mt-4">{{ ucwords(auth()->user()->roles) }} | <span style="font-size:22px;">Dashboard</span></h1>
            </div>
            <hr style="border:1px solid black;">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card y-gradient-cstm text-dark mb-4">
                        <div class="card-body fw-bold">
                            Messages
                            <div class="d-flex justify-content-between">
                                <a class="small text-dark stretched-link" href="{{ route('chat.index') }}">View Details</a>
                                @livewire('unread-messages-badge')
                                <div class="text-dark" style="font-size:36px; margin-top:-25px;">
                                    <i class="cstm-colorz fa-regular fa-handshake"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card b-gradient-cstm text-dark mb-4">
                        <div class="card-body fw-bold">
                            Pending Requested file
                            <div class="d-flex justify-content-between">
                                <a class="small text-dark stretched-link" href="{{route('pending.mon')}}">View Details</a>
                                <div class="text-dark" style="font-size:36px; margin-top:-25px;">
                                    <i class="text-danger fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container">
                <div>
                    <h4><b>News and Programs</b></h4>
                </div>
            
                <div id="headerCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($programs as $key => $program)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <img height="250" class="card-img-top" src="{{ asset('program_upload_img/'.$program['prog1']['cover']) }}" alt="Image 1">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $program['prog1']['title'] }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <img height="250" class="card-img-top" src="{{ asset('program_upload_img/'.$program['prog2']['cover']) }}" alt="Image 2">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $program['prog2']['title'] }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--<div class="carousel-control-prev">-->
                    <!--    <a class="carousel-control-prev-icon" href="#headerCarousel" role="button" data-bs-slide="prev">-->
                    <!--        <span class="rounded-circle cstm-carousel-btn material-symbols-outlined">arrow_back_ios_new</span>-->
                    <!--    </a>-->
                    <!--</div>-->
                    <!--<div class="carousel-control-next">-->
                    <!--    <a class="carousel-control-next-icon" href="#headerCarousel" role="button" data-bs-slide="next">-->
                    <!--        <span class="rounded-circle cstm-carousel-btn material-symbols-outlined">arrow_forward_ios</span>-->
                    <!--    </a>-->
                    <!--</div>-->
                </div>
            </div>
            
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pending Requests</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Request Type</th>
                                            <th>Date Requested</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendingRequests as $request)
                                        <tr>
                                            <td>{{ $request['request_type'] }}</td>
                                            <td>{{ $request['date_created']->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{route('pending.mon')}}" title="View Request" class="btn btn-sm btn-primary">
                                                    <i class="fa-regular fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Brgy. Calendar</h5>
                                <div id="brgy-calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('brgy-calendar');

        // Create a FullCalendar instance with responsive settings
        var calendar = new FullCalendar.Calendar(calendarEl, {
            height: 450,
            initialView: 'dayGridMonth',
            events: @json($calendarEvents),
            windowResize: function(view) {
                // Adjust calendar height and view based on window size
                if (window.innerWidth <= 768) {
                    // On small screens (mobile/tablets), switch to list view
                    calendar.changeView('listWeek');
                    calendar.setOption('height', 'auto'); // Automatically adjust the height
                } else {
                    // For larger screens, show the month grid view
                    calendar.changeView('dayGridMonth');
                    calendar.setOption('height', 450); // Set fixed height for larger screens
                }
            },
            eventClick: function(info) {
                // Show event details in a modal
                Swal.fire({
                    title: info.event.title,
                    html: `
                        <div><strong>Start:</strong> ${info.event.start.toLocaleString()}</div>
                        <div><strong>End:</strong> ${info.event.end ? info.event.end.toLocaleString() : 'N/A'}</div>
                        <div><strong>Description:</strong> ${info.event.extendedProps.description || 'No description'}</div>
                    `,
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            },
            // Enable responsiveness on mobile devices
            aspectRatio: 1.5, // Adjust aspect ratio for better layout
            views: {
                dayGridMonth: {
                    // Default month view settings
                    titleFormat: { month: 'long', year: 'numeric' },
                },
                listWeek: {
                    // Use a list view for smaller screens
                    titleFormat: { month: 'long', year: 'numeric' },
                    listDayAltFormat: { weekday: 'short', day: 'numeric' }
                },
            },
        });

        calendar.render();
    });
</script>

<style>
    /* Make the calendar container responsive */
    #brgy-calendar {
        max-width: 100%;
        margin: 0 auto;
    }

    /* Adjust for mobile devices */
    @media screen and (max-width: 768px) {
        /* Ensure that the calendar occupies full width on small screens */
        #brgy-calendar {
            width: 100%;
        }

        /* Adjust the calendar header for mobile */
        .fc-header-toolbar {
            font-size: 14px;
        }

        /* Make sure the events are spaced well */
        .fc-event {
            font-size: 12px;
        }
    }
</style>

<script src="{{ asset('assets/js/sb-script.js') }}"></script>
<link href="{{ asset('assets/css/sb-style.css') }}" rel="stylesheet" />

<script>
    const navLinks = document.querySelectorAll('.nav-link');
    const uri = window.location.href;
    const uriParts = uri.split('=');
    const uriValue = uriParts[uriParts.length - 1];
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        const hrefParts = href.split('=');
        const linkValue = hrefParts[hrefParts.length - 1];
    
        if (linkValue === uriValue) {
            link.classList.add('active-nav');
        }
    });
</script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/tabulator-tables@5.5.0/dist/css/tabulator_bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tabulator-tables@5.5.0/dist/js/tabulator.min.js"></script>
@endsection

@section('title', 'Staff Dashboard')
