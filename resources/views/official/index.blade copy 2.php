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
                <div class="row justify-content-center">
                    <!-- Topmost cards -->
                    <div class="col-md-6 text-center mb-4">
                        <div class="card top-official" onclick="toggleDetails(this)">
                            <div class="card-header">
                                <img src="{{ $officials[0]->photo ? asset($officials[0]->photo) : asset('/sys_logo/logo.png') }}" alt="{{ $officials[0]->name }}" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px;">
                                <h5 class="font-weight-bold">{{ $officials[0]->name }}</h5>
                                <span class="position">{{ $officials[0]->position }}</span>
                            </div>
                            <div class="card-body">
                                <p class="text-center" style="cursor:pointer;">Click to view details</p>
                                <div class="details-dropdown" style="display: none;">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Email:</strong> {{ $officials[0]->email }}</p>
                                            <p><strong>Contact:</strong> {{ $officials[0]->contact }}</p>
                                            <p class="description"><strong>Bio:</strong> {{ $officials[0]->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="btn-group" style="display: none;">
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="{{$officials[0]->id }}" data-official="{{ json_encode($officials[0]) }}"><i class="fas fa-edit"></i> Edit</button>
                                    @auth
                                    @if (auth()->user()->hasRole('admin'))
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{$officials[0]->id }}"><i class="fas fa-trash"></i> Delete</button>
                                    @endif @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center mb-4">
                        <div class="card top-official" onclick="toggleDetails(this)">
                            <div class="card-header">
                                <img src="{{ $officials[1]->photo ? asset($officials[1]->photo) : asset('/sys_logo/logo.png') }}" alt="{{ $officials[1]->name }}" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px;">
                                <h5 class="font-weight-bold">{{ $officials[1]->name }}</h5>
                                <span class="position">{{ $officials[1]->position }}</span>
                            </div>
                            <div class="card-body">
                                <p class="text-center" style="cursor:pointer;">Click to view details</p>
                                <div class="details-dropdown" style="display: none;">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Email:</strong> {{ $officials[1]->email }}</p>
                                            <p><strong>Contact:</strong> {{ $officials[1]->contact }}</p>
                                            <p class="description"><strong>Bio:</strong> {{ $officials[1]->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="btn-group" style="display: none;">
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="{{$officials[1]->id }}" data-official="{{ json_encode($officials[1]) }}"><i class="fas fa-edit"></i> Edit</button>
                                    @auth
                                    @if (auth()->user()->hasRole('admin'))
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{$officials[1]->id }}"><i class="fas fa-trash"></i> Delete</button>
                                    @endif @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="line" style="height: 30px; position: relative;">
                            <div class="connecting-line"></div>
                        </div>
                    </div>
                    <!-- Sub-official cards -->
                    @foreach($officials->slice(2) as $official)
                    <div class="col-md-3 mb-4">
                        <div class="card position-relative" onclick="toggleDetails(this)">
                            <div class="card-header text-center">
                                <img src="{{ $official->photo ? asset($official->photo) : asset('/sys_logo/logo.png') }}" alt="{{ $official->name }}" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px;">
                                <h5 class="font-weight-bold">{{ $official->name }}</h5>
                                <span class="position">{{ $official->position }}</span>
                            </div>
                            <div class="card-body">
                                <p class="text-center" style="cursor:pointer;">Click to view details</p>
                                <div class="details-dropdown" style="display: none;">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Email:</strong> {{ $official->email }}</p>
                                            <p><strong>Contact:</strong> {{ $official->contact }}</p>
                                            <p class="description"><strong>Bio:</strong> {{ $official->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="btn-group" style="display: none;">
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $official->id }}" data-official="{{ json_encode($official) }}"><i class="fas fa-edit"></i> Edit</button>
                                    @auth
                                    @if (auth()->user()->hasRole('admin'))
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $official->id }}"><i class="fas fa-trash"></i> Delete</button>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>

<style>
.card {
    position: relative;
}

.card-header {
    position: relative;
}

.line {
    width: 100%;
    text-align: center;
}

.connecting-line {
    display: inline-block;
    width: 60%;
    height: 2px;
    background: black;
    margin: 0 auto;
}

.details-dropdown {
    display: none;
    width: 200px;
}

.card:hover .details-dropdown {
    display: block;
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1;
}

.swal2-input,
.swal2-textarea {
    margin-bottom: 10px;
    width: 100%;
}

.custom-swal-container {
    overflow-x: hidden !important;
}

.btn-group {
    position: absolute;
    top: 10px;
    right: 10px;
    display: none;
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
