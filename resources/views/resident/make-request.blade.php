@extends('layouts.appres')

@section('content')

<div class="container-fluid">
    <button class="btn btn-primary" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> Go Back</button>
    <div class="m-4">
        <h2>Request Form</h2>
    </div>
    <div class="container d-flex main-c justify-content-center mb-3">
        <div class="row p-1 rounded d-flex justify-content-center w-100" style="max-width: 900px;">
            <div class="col-md-4 p-1" style="overflow-y: auto; max-height: 100vh;">
                <img id="serviceLogo" src="/sys_logo/logo.png" alt="Logo" class="img-fluid rounded">
            </div>
            <div class="col p-0" style="background-color: rgba(255,255,255,0.8); border-radius:10px;">
                <form id="requestForm" method="POST" action="{{ route('requestfilezz.submit') }}">
                    @csrf
                    <div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Request Type:</span>
                            <select id="requestType" class="text-primary form-select" name="request_type" required>
                                <option selected value="" disabled>Select</option>
                                <option value="Barangay Clearance">Barangay Clearance</option>
                                <option value="Certificate of Residency">Certificate of Residency</option>
                                <option value="Certificate of Indigency">Certificate of Indigency</option>
                                <option value="First Time Job Seeker Certification">First Time Job Seeker Certification
                                </option>
                                <option value="Barangay Business Clearance">Barangay Business Clearance</option>
                                <option value="Barangay ID">Barangay ID</option>
                            </select>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="form-group">
                                    <label>Tracking Code</label>
                                    <input class="form-control" name="tracking_code" id="trackingCode" readonly>
                                </div>
                                <div id="service_view">
                                    <!-- Start of Service View Sections -->

                                    <!-- Barangay Clearance section -->
                                    <div id="Barangay Clearance" class="service-section" style="display: none;">
                                        <div class="mt-3">
                                            <label>Full Name</label>
                                            <input class="form-control" type="text"
                                                value="{{ Auth::user()->fname }} {{ Auth::user()->middlename }} {{ Auth::user()->lname }}"
                                                name="barangay_fullname" placeholder="Enter your name" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mt-3 mb-3">
                                                <label>Date of Birth</label>
                                                <input class="form-control" id="dob" type="date" name="barangay_dob"
                                                    required>
                                            </div>
                                            <div class="col-6 mt-3 mb-3">
                                                <label>Age</label>
                                                <input class="form-control" id="age" type="number" name="barangay_age"
                                                    placeholder="Enter your age" readonly>
                                            </div>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label>Place of Birth</label>
                                            <input class="form-control" type="text" name="barangay_pob"
                                                placeholder="Enter your place of birth" required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label>Civil Status</label>
                                            <select class="form-select" name="barangay_civilStatus" required>
                                                <option value="" disabled selected>Select</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Separated">Separated</option>
                                            </select>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label>House Address</label>
                                            <input class="form-control" type="text" name="barangay_houseAddress"
                                                placeholder="House No, or Block, Lot, Phase, Street, Subdivision"
                                                required>
                                        </div>
                                        <div class="mt-2">
                                            <label>Purpose of getting barangay clearance</label>
                                            <textarea class="form-control" name="barangay_purpose"
                                                placeholder="Enter Purpose" required></textarea>
                                        </div>
                                    </div>

                                    <!-- Certificate of Residency section -->
                                    <div id="Certificate of Residency" class="service-section" style="display: none;">
                                        <div class="mt-3">
                                            <label>Full Name</label>
                                            <input class="form-control" type="text"
                                                value="{{ Auth::user()->fname }} {{ Auth::user()->middlename }} {{ Auth::user()->lname }}"
                                                name="residency_fullname" placeholder="Enter your name" required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label>House Address</label>
                                            <input class="form-control" type="text" name="residency_houseAddress"
                                                placeholder="House No, or Block, Lot, Phase, Street, Subdivision"
                                                required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label>Date of Residency</label>
                                            <input class="form-control" id="residency_date" type="date"
                                                name="residency_date" required>
                                        </div>
                                        <div class="mt-2">
                                            <label>Purpose of getting certificate residency</label>
                                            <textarea class="form-control" name="residency_purpose"
                                                placeholder="Enter Purpose" required></textarea>
                                        </div>
                                    </div>

                                    <!-- Certificate of Indigency section -->
                                    <div id="Certificate of Indigency" class="service-section" style="display: none;">
                                        <div class="mt-3">
                                            <label>Full Name</label>
                                            <input class="form-control" type="text"
                                                value="{{ Auth::user()->fname }} {{ Auth::user()->middlename }} {{ Auth::user()->lname }}"
                                                name="indigency_fullname" placeholder="Enter your name" required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label>House Address</label>
                                            <input class="form-control" type="text" name="indigency_houseAddress"
                                                placeholder="House No, or Block, Lot, Phase, Street, Subdivision"
                                                required>
                                        </div>
                                        <div class="mt-2">
                                            <label>Purpose of getting certificate indigency</label>
                                            <textarea class="form-control" name="indigency_purpose"
                                                placeholder="Enter Purpose"></textarea>
                                        </div>
                                    </div>

                                    <!-- First Time Job Seeker Certification section -->
                                    <div id="First Time Job Seeker Certification" class="service-section"
                                        style="display: none;">
                                        <div class="mt-3">
                                            <label>Full Name</label>
                                            <input class="form-control" type="text"
                                                value="{{ Auth::user()->fname }} {{ Auth::user()->middlename }} {{ Auth::user()->lname }}"
                                                name="job_seeker_fullname" placeholder="Enter your name" required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label>House Address</label>
                                            <input class="form-control" type="text" name="job_seeker_houseAddress"
                                                placeholder="House No, or Block, Lot, Phase, Street, Subdivision"
                                                required>
                                        </div>
                                        <div class="mt-2">
                                            <label>Purpose of getting Oath of Undertaking</label>
                                            <textarea class="form-control" name="job_seeker_purpose"
                                                placeholder="Enter Purpose"></textarea>
                                            /div>
                                        </div>

                                        <!-- Barangay Business Clearance section -->
                                        <div id="Barangay Business Clearance" class="service-section"
                                            style="display: none;">
                                            <div class="mt-3">
                                                <label>Business Name</label>
                                                <input class="form-control" type="text" name="business_name"
                                                    placeholder="Enter your business name" required>
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <label>Business Address</label>
                                                <input class="form-control" type="text" name="business_address"
                                                    placeholder="Bldg No, or Block, Lot, Phase, Street, Subdivision"
                                                    required>
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <label>Name of The Owner</label>
                                                <input class="form-control" type="text" name="owner_name"
                                                    placeholder="Owner's Name" required>
                                            </div>
                                        </div>

                                        <!-- Barangay ID section -->
                                        <div id="Barangay ID" class="service-section" style="display: none;">
                                            <div class="row">
                                                <div class="col-3 mt-3">
                                                    <label>Surname</label>
                                                    <input class="form-control" type="text"
                                                        value="{{ Auth::user()->lname }}" name="barangay_id_surname"
                                                        placeholder="" required>
                                                </div>
                                                <div class="col-4 mt-3">
                                                    <label>First Name</label>
                                                    <input class="form-control" type="text"
                                                        value="{{ Auth::user()->fname }}" name="barangay_id_firstName"
                                                        placeholder="" required>
                                                </div>
                                                <div class="col-3 mt-3">
                                                    <label>Middle Name</label>
                                                    <input class="form-control" type="text"
                                                        value="{{ Auth::user()->middlename }}"
                                                        name="barangay_id_middleName" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <label>House Address</label>
                                                <input class="form-control" type="text" name="barangay_id_address"
                                                    placeholder="House No, or Block, Lot, Phase, Street, Subdivision"
                                                    required>
                                            </div>
                                            <div class="mt-3">
                                                <label>Civil Status</label>
                                                <select class="form-select" name="barangay_id_civilStatus" required>
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-3 mt-3">
                                                    <label>Birthday</label>
                                                    <input class="form-control" type="date" id="brgy_dob"
                                                        name="barangay_id_bdate" placeholder="" required>
                                                </div>
                                                <div class="col-4 mt-3">
                                                    <label>Religion</label>
                                                    <input class="form-control" type="text" name="barangay_id_religion"
                                                        placeholder="" required>
                                                </div>
                                                <div class="col-4 mt-3">
                                                    <label>Birth Place</label>
                                                    <input class="form-control" type="text"
                                                        name="barangay_id_BirthPlace" placeholder="" required>
                                                </div>
                                                <div class="col-3 mt-3">
                                                    <label>Blood Type</label>
                                                    <input class="form-control" type="text" maxlength="3"
                                                        name="barangay_id_bloodtype" placeholder="Optional">
                                                </div>
                                                <div class="col-3 mt-3">
                                                    <label>Mobile Number</label>
                                                    <input class="form-control" type="text" maxlength="11"
                                                        name="barangay_id_mobilenum" placeholder="091234*****" required>
                                                </div>
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <label>Contact Person (in case of emergency)</label>
                                                <input class="form-control" type="text" name="barangay_id_contactperson"
                                                    placeholder="" required>
                                            </div>

                                            <div class="mt-3 mb-3">
                                                <label>Contact Number</label>
                                                <input class="form-control" type="text" maxlength="11"
                                                    name="barangay_id_contnum" placeholder="091234*****" required>
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <label>Relationship to the person</label>
                                                <input class="form-control" type="text" name="barangay_id_relationship"
                                                    placeholder="" required>
                                            </div>

                                            <!-- <div class="mt-2">
                                            <label>Purpose</label>
                                            <textarea class="form-control" name="barangay_id_purpose" placeholder="Enter Purpose"></textarea>
                                        </div> -->
                                        </div>
                                        <!-- End of Service View Sections -->
                                    </div>
                                    <div class="container mt-3 mb-3">
                                        <button type="submit" class="btn btn-success w-100" id="submitBtn">Submit
                                            Request</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Function to calculate age based on the date of birth
    function calculateAge() {
        const dob = document.getElementById('dob').value;
        const ageInput = document.getElementById('age');

        if (dob) {
            const birthDate = new Date(dob);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const month = today.getMonth();
            const day = today.getDate();

            // Check if the birthday has already occurred this year
            if (month < birthDate.getMonth() || (month === birthDate.getMonth() && day < birthDate.getDate())) {
                age--; // If not, subtract one year
            }

            ageInput.value = age; // Set the calculated age in the input field
        }
    }

    // Function to set the max date for DOB input field to ensure the user is 18 years or older
    function setMaxDOB() {
        const today = new Date();
        const minDate = new Date(today.setFullYear(today.getFullYear() - 18)); // Set date to 18 years ago
        const year = minDate.getFullYear();
        const month = String(minDate.getMonth() + 1).padStart(2, '0'); // Pad month for format
        const day = String(minDate.getDate()).padStart(2, '0'); // Pad day for format
        const maxDOB = `${year}-${month}-${day}`;

        // Set the max attribute for both DOB input fields
        document.getElementById('dob').setAttribute('max', maxDOB);
        document.getElementById('brgy_dob').setAttribute('max', maxDOB);
    }

    // Add event listener to calculate age when DOB changes
    document.getElementById('dob').addEventListener('change', calculateAge);

    // Call the setMaxDOB function when the page loads
    window.onload = setMaxDOB;
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const requestTypeSelect = document.getElementById('requestType');
        const serviceSections = document.querySelectorAll('.service-section');
        const trackingCodeInput = document.getElementById('trackingCode');

        function generateTrackingCode() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let segments = [];
            for (let i = 0; i < 2; i++) {
                let segment = '';
                for (let j = 0; j < 5; j++) {
                    segment += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                segments.push(segment);
            }
            return segments.join('-');
        }

        function updateServiceLogo(serviceType) {
            const serviceLogo = document.getElementById('serviceLogo');
            const logoMap = {
                "Barangay Clearance": "/clearance/barangay_clearance_logo.jpg",
                "Certificate of Residency": "/clearance/certificate_residency_logo.jpg",
                "Certificate of Indigency": "/clearance/certificate_indigency_logo.jpg",
                "First Time Job Seeker Certification": "/clearance/first_time_job_seeker_logo.jpg",
                "Barangay Business Clearance": "/clearance/barangay_business_clearance_logo.jpg",
                "Barangay ID": "/clearance/barangay_id_logo.jpg"
            };
            serviceLogo.src = logoMap[serviceType] || "/sys_logo/logo.png";
        }

        // Function to hide all service sections
        function hideAllSections() {
            const sections = document.querySelectorAll('.service-section');
            sections.forEach(section => section.style.display = 'none');
        }

        // Function to show the selected service section
        function showSection(sectionId) {
            hideAllSections();  // Hide all sections first
            const section = document.getElementById(sectionId);
            if (section) {
                section.style.display = 'block';  // Show the selected section
            }
        }

        // Function to handle submit button enable/disable
        function toggleSubmitButton() {
            const submitButton = document.getElementById('submitBtn');
            const requestTypeSelect = document.getElementById('requestType');
            const selectedType = requestTypeSelect.value;

            // Disable submit button if no valid request type is selected
            if (selectedType === '' || selectedType === 'select') {
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
        }

        // Function to validate required fields in the selected section
        function validateRequiredFields(sectionId) {
            const section = document.getElementById(sectionId);
            const requiredFields = section.querySelectorAll('[required]');
            let missingFields = [];

            requiredFields.forEach(field => {
                if (field.value.trim() === '' || (field.tagName === 'SELECT' && field.value === '')) {
                    missingFields.push(field);
                    // Highlight missing field
                    field.style.border = '2px solid red';
                } else {
                    // Remove highlight if field is filled
                    field.style.border = '';
                }
            });

            // Return false if there are missing required fields to block form submission
            if (missingFields.length > 0) {
                return false;
            }

            return true;  // All required fields are filled
        }

        // Add event listener for change event on requestType dropdown
        requestTypeSelect.addEventListener('change', function () {
            const selectedType = this.value;
            // Show the section corresponding to the selected request type
            showSection(selectedType);
            // Enable/disable submit button based on selection
            toggleSubmitButton();
        });

        // Handle form submission with SweetAlert
        document.getElementById('submitBtn').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default form submission

            const selectedType = requestTypeSelect.value;
            const isValid = validateRequiredFields(selectedType);  // Validate required fields in the selected section

            if (!isValid) {
                Swal.fire({
                    title: 'Please complete all required fields.',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                });
                return;  // Prevent form submission if validation fails
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to submit this request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('requestForm').submit(); // Submit the form if confirmed
                }
            });
        });

        // Initialize tracking code
        trackingCodeInput.value = generateTrackingCode();

        // Initialize by hiding all sections and showing the default one if needed
        hideAllSections();  // Initially hide all sections

        // Optional: You can set the default selected option manually if needed
        if (requestTypeSelect.value) {
            showSection(requestTypeSelect.value);
        }

        // Initial check to enable/disable the submit button
        toggleSubmitButton();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to get the current date in YYYY-MM-DD format
        function getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = ('0' + (today.getMonth() + 1)).slice(-2); // Ensures two-digit month
            const day = ('0' + today.getDate()).slice(-2); // Ensures two-digit day
            return `${year}-${month}-${day}`;
        }

        // Set the current date to the input field
        const residencyDateInput = document.getElementById('residency_date');
        residencyDateInput.value = getCurrentDate();

        // Set the min and max date restrictions
        const minDate = '1980-01-01';  // Minimum date restriction (start of the 1980s)
        const maxDate = getCurrentDate();  // Maximum date restriction (current date)

        // Set the input field to allow dates between 1980 and today
        residencyDateInput.setAttribute('min', minDate);
        residencyDateInput.setAttribute('max', maxDate);

        // Event listener to ensure future dates cannot be selected
        residencyDateInput.addEventListener('input', function () {
            const selectedDate = new Date(residencyDateInput.value);
            const today = new Date();

            // If the selected date is in the future, reset to the current date
            if (selectedDate > today) {
                residencyDateInput.value = getCurrentDate();
                alert('Future dates are not allowed. The date has been reset to today.');
            }

            // If the selected date is before 1980, reset to the minimum date
            if (selectedDate < new Date(minDate)) {
                residencyDateInput.value = minDate;
                alert('Dates before 1980 are not allowed. The date has been reset to the earliest valid date.');
            }
        });
    });
</script>



@endsection
@section('title', 'Make Request')