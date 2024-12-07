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
                <h1 class="text-center">Barangay and SK Officials Organization Chart</h1>
                @auth
                @if (auth()->user()->hasRole('admin'))
                <div class="d-flex justify-content-end mb-4">
                    <button class="btn btn-info" id="addOfficialBtn"><i class="fas fa-pencil"></i><i class="fas fa-plus"></i> Add Official</button>
                </div>
                @endif @endauth
    <div class="container mt-5">
        <div class="row">
            <!-- Captain Section -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <img src="captain_image.png" class="rounded-circle mb-3" alt="Captain" width="100" height="100">
                        <h5 class="card-title">Jario, Andres P</h5>
                        <p class="text-muted">Captain</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Age: 29</li>
                            <li class="list-group-item">Gender: Male</li>
                            <li class="list-group-item">Civil Status: Single</li>
                            <li class="list-group-item">Birth Date: Feb 02, 2010</li>
                            <li class="list-group-item">Contact: 2147483647</li>
                            <li class="list-group-item">Term: 2018-2020</li>
                            <li class="list-group-item">
                                Status: <span class="badge bg-success">Active</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Other Officials Section -->
            <div class="col-md-8">
                <div class="row">
                    <!-- Card template -->
                    <div class="col-md-6">
                        <div class="card text-center mb-3" style="border-top: 5px solid #17a2b8;">
                            <div class="card-body">
                                <h5 class="card-title">Amorio, Crischel</h5>
                                <p class="text-muted">Kagawad</p>
                                <p>Age: 40</p>
                                <p>Status: <span class="badge bg-success">Active</span></p>
                                <a href="#" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-center mb-3" style="border-top: 5px solid #007bff;">
                            <div class="card-body">
                                <h5 class="card-title">Mage, Alice</h5>
                                <p class="text-muted">SK Chairman</p>
                                <p>Age: 40</p>
                                <p>Status: <span class="badge bg-success">Active</span></p>
                                <a href="#" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-center mb-3" style="border-top: 5px solid #6c757d;">
                            <div class="card-body">
                                <h5 class="card-title">Fighter, Alucard</h5>
                                <p class="text-muted">Member</p>
                                <p>Age: 40</p>
                                <p>Status: <span class="badge bg-success">Active</span></p>
                                <a href="#" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-center mb-3" style="border-top: 5px solid #dc3545;">
                            <div class="card-body">
                                <h5 class="card-title">Assassin, Helcurt</h5>
                                <p class="text-muted">Chairperson</p>
                                <p>Age: 23232</p>
                                <p>Status: <span class="badge bg-success">Active</span></p>
                                <a href="#" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-center mb-3" style="border-top: 5px solid #ffc107;">
                            <div class="card-body">
                                <h5 class="card-title">Mage, Harith</h5>
                                <p class="text-muted">SB Member</p>
                                <p>Age: 0</p>
                                <p>Status: <span class="badge bg-success">Active</span></p>
                                <a href="#" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    body {
    background-color: #f8f9fa;
}

.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card img {
    border-radius: 50%;
}

.card-body {
    padding: 20px;
}

.badge {
    font-size: 1rem;
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
        title: 'Add Official',
        html: `
            <div style="text-align: left;">
                <input type="file" id="photo" class="swal2-input" accept="image/*" required>
                <input type="text" id="name" class="swal2-input" placeholder="Name" required>
                <input type="text" id="position" class="swal2-input" placeholder="Position" required>
                <input type="email" id="email" class="swal2-input" placeholder="Email" required>
                <input type="text" id="contact" class="swal2-input" placeholder="Contact Number" required>
                <textarea id="description" class="swal2-textarea" placeholder="Description (optional)"></textarea>
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
                document.getElementById('description').value
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
            // AJAX request to store the official
            fetch('/save-officials', {
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
                <div style="text-align: left;">
                    <input type="file" id="editPhoto" class="swal2-input" accept="image/*">
                    <input type="text" id="editName" class="swal2-input" placeholder="Name" value="${official.name}" required>
                    <input type="text" id="editPosition" class="swal2-input" placeholder="Position" value="${official.position}" required>
                    <input type="email" id="editEmail" class="swal2-input" placeholder="Email" value="${official.email}" required>
                    <input type="text" id="editContact" class="swal2-input" placeholder="Contact Number" value="${official.contact}" required>
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

                // Return the collected data
                return [photoFile, name, position, email, contact, description];
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
                formData.append('_method', 'PUT');           

                // AJAX request to update the official
                fetch(`/update-official/${official.id}`, {
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
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX request to delete the official
                fetch(`/delete-official/${officialId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire('Deleted!', 'Official has been deleted.', 'success');
                        location.reload();
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
@section('title','Brgy. Officials')
