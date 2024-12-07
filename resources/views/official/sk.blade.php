@extends('layouts.app')

@section('content')
@include('layouts.sidebar')
<div id="layoutSidenav_content" style="background-color: rgb(240,236,236);">
    <main>
        <div class="container-fluid px-4">
            <div class="d">
                <h1 class="mt-4">{{ ucwords(auth()->user()->roles) }} | <span style="font-size:22px;">View</span></h1>
            </div>
            <hr style="border:1px solid black;">
            <div class="container">
                <h1 class="text-center">SK Officials Organization Chart</h1>
                <div class="nav-classlink">
  <div class="nav" style="margin-top: 20px;">
    <ul class="nav nav-tabs" style="background-color: #f8f9fa; border-radius: 8px; padding: 10px;">
        <li class="nav-item">
            <a class="nav-link  " aria-current="page"  href="{{route('official.index')}}"style="color: #333; font-size: 16px;">Barangay Officials  </a>
        </li>
         <li class="nav-item">
            <a class="nav-link active " style="color:green; font-weight:bold;" aria-current="page"  href="{{route('SKofficial.index')}}" style="color: #333; font-size: 16px; ">SK Officials</a>
        </li>
    </ul>
</div>
               
                <div class="d-flex justify-content-end mb-4">
                    <button class="btn btn-primary mt-3"  id="addOfficialBtn">
                        <i class="fas fa-pencil"></i> <i class="fas fa-plus"></i> Add SK Official
                    </button>
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
                <p class="text-center">No other SK Officials to display.</p>
            </div>
        @endif
    </div>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('addOfficialBtn').addEventListener('click', function() {
    Swal.fire({
    title: 'Add SK Official',
    html: `
        <div class="swal2-content" style="text-align: left; font-family: Arial, sans-serif;">
    <style>
        .swal2-content {
            max-width: 500px; /* Set a max width for the modal */
            margin: auto; /* Center the modal */
        }

        .swal2-input, .swal2-textarea {
            width: 80%; /* Full width */
            padding: 10px; /* Consistent padding inside inputs */
            margin-bottom: 15px; /* Space between inputs */
            border: 1px solid #ccc; /* Light border */
            border-radius: 4px; /* Rounded corners */
            transition: border-color 0.3s, box-shadow 0.3s; /* Transition for focus */
            box-sizing: border-box; /* Include padding and border in total width */
        }

        .swal2-input:focus, .swal2-textarea:focus {
            border-color: #007bff; /* Focus border color */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Subtle shadow */
            outline: none; /* Remove default outline */
        }

        input[type="file"] {
            border: none; /* Remove border for file input */
            padding: 15px; /* Padding for file input */
            margin-bottom: 15px; /* Space below file input */
            cursor: pointer; /* Pointer cursor for file input */
            width: calc(85% - 20px); /* Ensure file input matches other input widths */
        }

        input[type="file"]::file-selector-button {
            background-color: #007bff; /* Button background color */
            color: white; 
            border: none; 
            border-radius: 4px; 
            padding: 10px 15px; 
            cursor: pointer; /* Pointer cursor */
            transition: background-color 0.3s; /* Transition for hover effect */
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #0056b3; /* Darker background on hover */
        }

        h3 {
            color: #333; /* Dark color for title */
            margin-bottom: 15px; /* Space below title */
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
    </style>
    <h3>SK Official Information</h3>
    
    <label for="photo">Photo</label>
    <input type="file" id="photo" class="swal2-input" accept="image/*" required>

    <label for="name">Name</label>
    <input type="text" id="name" class="swal2-input" required>

    <label for="position">Position</label>
    <input type="text" id="position" class="swal2-input"  required>

    <label for="email">Email</label>
    <input type="email" id="email" class="swal2-input"  required>

    <label for="term">Term</label>
    <input type="text" id="term" class="swal2-input"  required>

    <label for="contact">Contact Number</label>
    <input type="text" id="contact" maxlength="11" class="swal2-input" placeholder="09123456789" required>

    <label for="description">Description</label>
    <textarea id="description" class="swal2-textarea" placeholder="(optional)"></textarea>
</div>

    `,
        focusConfirm: false,
        confirmButtonText: 'Submit',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        preConfirm: () => {
            return [
                document.getElementById('photo').files[0],
                document.getElementById('name').value,
                document.getElementById('position').value,
                document.getElementById('email').value,
                document.getElementById('contact').value,
                document.getElementById('description').value,
                document.getElementById('term').value
            ];
        },
        customClass: {
            container: 'custom-swal-container'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('photo', result.value[0]);
            formData.append('name', result.value[1]);
            formData.append('position', result.value[2]);
            formData.append('email', result.value[3]);
            formData.append('contact', result.value[4]);
            formData.append('description', result.value[5]);
            formData.append('term', result.value[6]);
            // AJAX request to store the official
            fetch('/save-SKofficials', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire('Success!', 'Official added successfully!', 'success');
                    location.reload();
                } else {
                    Swal.fire('Error!', 'There was an error adding the official.', 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Something went wrong!', 'error');
            });
        }
    });
});

// Show edit and delete buttons on hover
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.querySelector('.btn-group').style.display = 'block';
    });
    card.addEventListener('mouseleave', function() {
        this.querySelector('.btn-group').style.display = 'none';
    });
});
// Edit button logic
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const official = JSON.parse(this.getAttribute('data-official'));
        Swal.fire({
    title: 'Edit Official',
    html: `
        <div class="swal2-content" style="text-align: left; font-family: Arial, sans-serif;">
            <style>
                .swal2-content {
                    max-width: 500px; /* Set a max width for the modal */
                    margin: auto; /* Center the modal */
                }

                .swal2-input, .swal2-textarea {
                    width: 80%; /* Full width */
                    padding: 10px; /* Consistent padding inside inputs */
                    margin-bottom: 15px; /* Space between inputs */
                    border: 1px solid #ccc; /* Light border */
                    border-radius: 4px; /* Rounded corners */
                    transition: border-color 0.3s, box-shadow 0.3s; /* Transition for focus */
                    box-sizing: border-box; /* Include padding and border in total width */
                }

                .swal2-input:focus, .swal2-textarea:focus {
                    border-color: #007bff; /* Focus border color */
                    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Subtle shadow */
                    outline: none; /* Remove default outline */
                }

                input[type="file"] {
                    border: none; /* Remove border for file input */
                    padding: 10px; /* Padding for file input */
                    margin-bottom: 15px; /* Space below file input */
                    cursor: pointer; /* Pointer cursor for file input */
                    width: calc(85% - 20px); /* Ensure file input matches other input widths */
                }

                input[type="file"]::file-selector-button {
                    background-color: #007bff; /* Button background color */
                    color: white; /* Button text color */
                    border: none; /* No border */
                    border-radius: 4px; /* Rounded corners */
                    padding: 10px 15px; /* Padding for button */
                    cursor: pointer; /* Pointer cursor */
                    transition: background-color 0.3s; /* Transition for hover effect */
                }

                input[type="file"]::file-selector-button:hover {
                    background-color: #0056b3; /* Darker background on hover */
                }
            </style>
            <h3>Official Information</h3>
            <input type="file" id="editPhoto" class="swal2-input" accept="image/*">
            <input type="text" id="editName" class="swal2-input" placeholder="Name" value="${official.name}" required>
            <input type="text" id="editPosition" class="swal2-input" placeholder="Position" value="${official.position}" required>
            <input type="email" id="editEmail" class="swal2-input" placeholder="Email" value="${official.email}" required>
            <input type="text" id="editContact" class="swal2-input" maxlength="11" placeholder="Contact Number" value="${official.contact}" required>
             <input type="text" id="editTerm" class="swal2-input" placeholder="Term" value="${official.term}" required>
            <textarea id="editDescription" class="swal2-textarea" placeholder="Description (optional)">${official.description}</textarea>
        </div>
    `,
            focusConfirm: false,
            confirmButtonText: 'Update',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const photoFile = document.getElementById('editPhoto').files[0];
                const name = document.getElementById('editName').value;
                const position = document.getElementById('editPosition').value;
                const email = document.getElementById('editEmail').value;
                const contact = document.getElementById('editContact').value;
                const description = document.getElementById('editDescription').value;
                const term = document.getElementById('editTerm').value;

                // Return the collected data
                return [photoFile, name, position, email, contact, description, term];
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();

                // Only append the photo if it's provided
                if (result.value[0]) {
                    formData.append('photo', result.value[0]);
                }
                formData.append('name', result.value[1]);
                formData.append('position', result.value[2]);
                formData.append('email', result.value[3]);
                formData.append('contact', result.value[4]);
                formData.append('description', result.value[5]);
                formData.append('term', result.value[6]);
                formData.append('_method', 'PUT');           

                // AJAX request to update the official
                fetch(`/update-SKofficial/${official.id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    })
                .then(response => {
                    console.log(response);
                    if (response.ok) {
                        return response.json(); 
                    } else {
                        throw new Error('Network response was not ok.');
                    }
                })
                .then(data => {
                    console.log(data);
                    Swal.fire('Success!', 'Official updated successfully!', 'success');
                    location.reload(); 
                })
                .catch(error => {
                    console.error(error); 
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                });
            }
        });
    });
});
// Delete button logic
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const officialId = this.getAttribute('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX request to delete the official
                fetch(`/delete-SKofficial/${officialId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire('Deleted!', 'Official has been deleted.', 'success');
                        location.reload(); // Reload the page to see changes
                    } else {
                        Swal.fire('Error!', 'There was an error deleting the official.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                });
            }
        });
    });
});
</script>

<!-- Stylesheets and Scripts -->
<script src="{{ asset('assets/js/sb-script.js') }}"></script>
<link href="{{ asset('assets/css/sb-style.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">
<script src="{{ asset('assets/js/a-dash-script.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/tabulator-tables@5.5.0/dist/css/tabulator_bootstrap5.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tabulator-tables@5.5.0/dist/js/tabulator.min.js"></script>
@endsection
@section('title','SK Officials')
