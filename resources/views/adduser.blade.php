<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Intl Tel Input CSS -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

    <style>
        .container1 {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon {
            width: 30px;
            height: auto;
        }
    </style>
</head>

<body>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">User Registration</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('add.user') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- First Name -->
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" pattern="[A-Za-z]+" class="form-control" name="username" placeholder="Enter first name">
                            @error('username')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Surname -->
                        <div class="mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" pattern="[A-Za-z]+" class="form-control" name="surname" placeholder="Enter surname">
                            @error('surname')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                            @error('email')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- DOB -->
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob">
                            <small class="text-muted">You must be at least 18 years old</small>
                            @error('dob')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mobile No</label>

                            <input type="tel"
                                class="form-control"
                                name="mobile"
                                id="mobile"
                                placeholder="Enter mobile number">

                            <input type="hidden" name="country_code" id="country_code">

                            @error('mobile')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>


                     
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                            @error('password')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>
  
                   
                        <div class="mb-3">
                            <label class="form-label">Adhar No</label>
                            <input type="text"
                                    class="form-control"
                                    name="adhar"
                                    placeholder="Enter 12 digit Aadhaar"
                                    maxlength="12"
                                    pattern="\d{12}"
                                    inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);"
                                    required>

                            @error('adhar')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>

                 
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>

                            <div class="container1">
                                <input type="file" class="form-control" id="imageInput" name="image">
                                <img id="imagePreview" class="icon" src="#" style="display:none;">
                            </div>

                            @error('image')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

<script>
var input = document.querySelector("#mobile");

var iti = window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    preferredCountries: ["in", "us", "gb"]
});


input.addEventListener("blur", function () {

    var countryData = iti.getSelectedCountryData();

    
    document.getElementById("country_code").value = "+" + countryData.dialCode;

});


const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');

imageInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const fileUrl = URL.createObjectURL(file);
        imagePreview.src = fileUrl;
        imagePreview.style.display = 'block';
    }
});
</script>

</body>
</html>
