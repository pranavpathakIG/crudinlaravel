<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
</head>
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
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Update User</h5>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('alert'))
                        <div class="alert alert-danger">{{ session('alert') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('update.user', ['id' => $ok->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" 
                                   class="form-control"
                                   name="name" 
                                   value="{{ $ok->name }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" 
                                   class="form-control"
                                   name="surname" 
                                   value="{{ $ok->surname }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control"
                                   name="email" 
                                   value="{{ $ok->email }}" 
                                   required>
                                @error('email')
                                    <div style="color:red; margin-top:5px;">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" 
                                   class="form-control"
                                   name="dob" 
                                   value="{{ $ok->DOB }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mobile No</label>
                            <input type="tel"
                                class="form-control"
                                name="mobile"
                                id="mobile"
                                value="{{ $ok->mobile }}"
                                placeholder="Enter mobile number">

                            <input type="hidden" name="country_code" id="country_code" value="{{ $ok->country_code ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" 
                                   class="form-control"
                                   name="password">
                            <small class="text-muted">
                                Leave blank to keep current password
                            </small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adhar No</label>
                            <input type="text" 
                                   class="form-control"
                                   name="adhar" 
                                   value="{{ $ok->adhar }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <div class="container1">
                            <input type="file" 
                                   class="form-control"
                                    id="imageInput"
                                   name="image">
                                   <img id="imagePreview" class="icon" src="#" style="display:none;">
                            </div>
                            @if($ok->image)
                                <img src="{{ asset('images/' . $ok->image) }}" alt="User Image" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                Update
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

// initialize widget from stored country_code (if present)
(function setInitialCountryFromStoredValue(){
    var stored = document.getElementById('country_code').value; // like "+91" or empty
    if(stored){
        var dial = stored.replace(/^\+/, '');
        var match = iti.getCountryData().find(function(c){ return c.dialCode === dial; });
        if(match){
            iti.setCountry(match.iso2);
        }
    }
})();

// keep hidden field updated whenever country changes or on blur
input.addEventListener("countrychange", function(){
    var countryData = iti.getSelectedCountryData();
    document.getElementById("country_code").value = "+" + countryData.dialCode;
});

input.addEventListener("blur", function () {
    var countryData = iti.getSelectedCountryData();
    document.getElementById("country_code").value = "+" + countryData.dialCode;
});

// ensure hidden country_code is present at submit time
var formEl = document.querySelector('form');
formEl.addEventListener('submit', function(){
    var countryData = iti.getSelectedCountryData();
    document.getElementById("country_code").value = "+" + (countryData.dialCode || '91');
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